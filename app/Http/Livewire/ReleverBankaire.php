<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Imports\releverBancaireImport;

use Illuminate\Http\UploadedFile;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

use App\Models\Cheque;
use App\Models\Compte;
use App\Models\ReleverBancaire;
use App\Models\Transaction;

class ReleverBankaire extends Component
{

    use WithFileUpLoads;
    use WithPagination;

    public $id_Relever, $dateRelever;

    // public $pages = 10;
    // public $bulkDisabled = true;
    // public $selectedCharges = [];
    // public $selectAll = false;
    // protected $queryString  = ['search'];

    // // TRANSACTION
    public $id_Trans, $date_Operation, $libelle, $debit, $credit, $date_Valeur, $typeCheck;
    // // COMPTE
    public $id_Compte, $numCompte;
    // // CHEQUE
    public $id_cheque, $numCheque;

    public $file;
    public $filter;
    

    public function render()
    {

        $releverB = ReleverBancaire::where('id', $this->id_Relever)->first();

        if ($this->filter) {
            $releverB = $this->filterByDate($this->filter);
            if (!is_null($releverB)) {

                // test compte later on
                $transactions = Transaction::where('id_releverbancaire', $releverB->id)->get();
            } else {
                $transactions = null;
            }
        } else {
            $releverB = ReleverBancaire::where('id', $this->id_Relever)->first();
            if (!is_null($releverB)) {
                $transactions = Transaction::where('id_releverbancaire', $releverB->id)->get();
            } else {
                $transactions = null;
            }
        }
        // dd($transactions);
        return view('livewire.owner.relever-bankaire', ['transactions' => $transactions, 'releverB' => $releverB]);
    }



    // filter by month
    public function filterByDate($filter)
    {
        $date = explode('-', $filter);
        $releverByDate = ReleverBancaire::Where('dateR', 'like', '%' . $date[0] . '-' . $date[1] . '-%')->first();
        $this->filter = null;
        return $releverByDate;
    }













    public function importData()
    {
       $this->validate([
        'file' => 'required|mimes:xlsx,xls'
       ]);
       
        $data = Excel::toArray(new releverBancaireImport, $this->file);
      
        // dd($data);

        // START (GETTING DATE AND ID_COMPTE AND CREATE A NEW RECORD ON THE DATABASE RELEVER BANCAIRE TABLE)
        $this->dateRelever = $this->getDateReleverBank($data[0][0]);
        $this->numCompte = $this->getNumeroCompte($data[0][2]);
        $compte = Compte::where('numero', $this->numCompte)->first();
      
        if ($compte) {
            $releverB = ReleverBancaire::create([
                'dateR' => $this->dateRelever,
                'compte_id' => $compte->id
            ]);
            $this->id_Relever = $releverB->id;
        } else {
            $releverB = ReleverBancaire::create([
                'dateR' => $this->dateRelever,
                'compte_id' => null
            ]);
            $this->id_Relever = $releverB->id;
        }
        // END
        $this->getTransData($data[0]);
    }


    // get the date of the relever bancaire
    public function getDateReleverBank($array)
    {
        $str = $array[0];
        $getdate = explode(' ', $str);
        $date = $getdate[sizeof($getdate) - 1];
        return $date;
    }


    // get num of the Compte
    public function getNumeroCompte($array)
    {
        $str = $array[0];
        $getnumC = explode(' ', $str);
        $numC = $getnumC[sizeof($getnumC) - 1];
        return $numC;
    }

    // get transaction area (row,col) [dateO, libelle, credit, debit, dateV]
    public function getTransArea($array)
    {
        $arrTrans = [];
        for ($i = 7; $i < sizeof($array); $i++) {
            if (is_null($array[$i][0])) {
                break;
            } else {
                array_push($arrTrans, $array[$i]);
            }
        }
        return $arrTrans;
    }


    // $id_Trans, $typePayment;
    // get transactions data
    public function getTransData($array)
    {
        $arrTrans = $this->getTransArea($array);
        for ($i = 0; $i < sizeof($arrTrans); $i++) {
            $this->libelle = $this->verifyLibelle($arrTrans[$i][1]);
            $this->getDeepOnLibelle($this->libelle);
            $this->debit = $this->verifyFloat($arrTrans[$i][2]);
            $this->credit = $this->verifyFloat($arrTrans[$i][3]);

            $this->date_Operation = $this->verifyDate($arrTrans[$i][0]);
            $this->date_Valeur = $this->verifyDate($arrTrans[$i][4]);

            // CREATE A TRANSACTION RECORD
            $transaction = Transaction::create([
                'id_cheque' => $this->id_cheque,
                'id_releverbancaire' => $this->id_Relever,
                'date_Operation' => $this->date_Operation,
                'date_Valeur' => $this->date_Valeur,
                'typeCheck' => $this->typeCheck,
                'libelle' => $this->libelle,
                'credit' => $this->credit,
                'debit' => $this->debit
            ]);
            $this->updateSoldBancaire($transaction);
        }
    }

    public function verifyDate($date)
    {
        $adjustingDate = explode("/", $date);
        $newDate = "";
        for ($i = 0; $i < sizeof($adjustingDate); $i++) {
            $newDate = $newDate . $adjustingDate[sizeof($adjustingDate) - ($i + 1)] . '-';
        }
        return $newDate;
    }

    // get rid of this => ' .
    public function verifyLibelle($lib)
    {
        $modifiedLibelle = str_replace("'", "_", $lib);
        return $modifiedLibelle;
    }

    // get rid of this => , .
    public function verifyFloat($myFloat)
    {
        $tostring = (string) $myFloat;
        $modifiedFloat = str_replace(",", ".", $tostring);
        return floatval($modifiedFloat);
    }

    public function getDeepOnLibelle($libelle)
    {
        $libelleArr = explode(" ", $libelle);
        if ($libelleArr[1] == 'CHEQUE') {
            // type pr situation cheque and the num of that cheque
            $this->typeCheck = $libelleArr[0];
            $this->numCheque = $libelleArr[2];

            //Check for the id of the cheque on the Cheques table (and modify the situation as needed)
            $cheque = Cheque::where('numero', $this->numCheque)->first();
            if (!is_null($cheque)) {
                $this->id_cheque = $cheque->id;
                $cheque->situation = $this->typeCheck;
                $cheque->save();
            }
        } else {
            $this->typeCheck = null;
            $this->numCheque = null;
        }
    }


    //update the Bank Account
    public function updateSoldBancaire($transaction)
    {
        $compte = Compte::where('numero', $this->numCompte)->first();

        if (!is_null($compte)) {
            //credit---------------------
            $oldSoldNumeric = floatval($compte->sold);
            $NewSoldNumeric = $oldSoldNumeric + $transaction->credit;
            $compte->sold = (string) $NewSoldNumeric;
            $compte->save();

            // debit---------------------
            $oldSoldNumeric = floatval($compte->sold);
            $NewSoldNumeric = $oldSoldNumeric - $transaction->debit;
            $compte->sold = (string) $NewSoldNumeric;
            $compte->save();
        }


        // $compte->sold = $compte->sold + $transaction->credit;
        // $compte->sold = $compte->sold - $transaction->debit;
        // $compte->save();
    }
}
