<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Charge;
use App\Models\Projet;
use App\Models\Cheque;
use App\Models\Fournisseur;
use App\Models\Reglement;
use App\Models\Facture;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class ChargesList extends Component
{
    use WithFileUpLoads;
    use WithPagination;

    public $id_Charge, $name, $fournisseur_id, $id_projet, $type,
        $bon, $prix_ht, $tva, $QT, $prix_TTC, $MTTTC, $situation;
    public $selectedOption;
    public $pages = 10;
    public $bulkDisabled = true;
    public $selectedCharges = [];
    public $selectAll = false;
    public $filter;
    public $search = "";
    // protected $queryString  = ['search'];

    // reglement
    public $montant, $dateR, $methode, $numero_cheque, $id_facture;
    public $numFacture;
    public $errordAjoutReg = false;
    // Method check or Cash


    public function updatedPages()
    {
        $this->resetPage('new');
    }

    public function render()
    {
        $this->bulkDisabled = count($this->selectedCharges) < 1;
        $fournisseurs = Fournisseur::all();
        $projets = Projet::all();
        $cheques = Cheque::where('situation', 'disponible')->get();


        // FILLTER BY SITUATION PAYED OR NOT PAYED
        switch ($this->filter) {
            case 'payed':
                $charges = Charge::where('situation', 'payed')->paginate($this->pages, ['*'], 'new');
                break;
            case 'notPayed':
                $charges = Charge::where('situation', 'notPayed')->paginate($this->pages, ['*'], 'new');
                break;
            default:
                $charges = Charge::orderBy('id', 'DESC')->paginate($this->pages, ['*'], 'new');
                break;
        }
        if ($this->search != "") {
            $charges = Charge::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('type', 'like', '%' . $this->search . '%')->paginate($this->pages, ['*'], 'new');
        }
        return view('livewire.charges-list', ['charges' => $charges, 'fournisseurs' => $fournisseurs, 'projets' => $projets, 'cheques' => $cheques]);
    }



    // REGLEMENTS

    // method cheque ou non cheque
    public $optionC = false;
    public function optionCheque()
    {
        if ($this->optionC) {
            $this->optionC = false;
        } else {
            $this->optionC = true;
        }
    }

    public $avecF = false;
    public function avecFacture()
    {
        if ($this->avecF) {
            $this->avecF = false;
        } else {
            $this->avecF = true;
        }
    }

    // REGLEMENT CRUD
    public function addReg()
    {
        $this->validate([
            'dateR' => 'required',
            'montant' => 'required',
        ]);
        $pass = true;

        // getting the facture's id from facture table
        if (!(is_null($this->numFacture))) {
            $facture = Facture::where('numero', $this->numFacture)->first();
            if (is_null($facture)) {
                session()->flash('error', 'error on numero facture');
                $this->id_facture = "";
                $pass = false;
                $this->numFacture = null;
            } else {
                $this->id_facture = $facture->id;
            }
        }
        if (!is_null($this->numero_cheque)) {
            $this->methode = 'cheque';
            if (!($this->verifyCheque($this->numero_cheque))) {
                session()->flash('error', 'error on numero cheque');
                $this->numero_cheque = null;
                $pass = false;
            } else {
                $pass = true;
            }
        } else {
            $this->methode = 'cash';
            $this->numero_cheque = null;
        }
        if ($pass) {
            $reglement = Reglement::create([
                'dateR' => $this->dateR,
                'montant' => $this->montant,
                'methode' => $this->methode,
                'numero_cheque' => $this->numero_cheque,
                'id_facture' => $this->id_facture,
                'id_contrat' => null,
            ]);

            //modifier cheque situation
            if (!is_null($reglement->numero_cheque)) {
                $cheque = Cheque::where('numero', $reglement->numero_cheque)->first();
                if (!is_null($cheque)) {
                    $cheque->situation = "livrer";
                    $cheque->save();
                }
            }
            session()->flash('message', 'Reglement added successfully');
            $this->resetInputs();
            $this->updateChargeAfterReg($reglement);
            $this->dispatchBrowserEvent('close-model');
        }
    }



    //check whether the numero cheque exist on table cheques also check its situation
    public function verifyCheque($numCheque)
    {
        $cheque = Cheque::where('numero', $numCheque)->first();
        if (is_null($cheque)) {
            return false;
        } else {
            if ($cheque->situation == 'disponible') {
                return true;
            } else {
                return false;
            }
        }
    }






    public function updateChargeAfterReg($reglement)
    {
        foreach ($this->selectedCharges as $ch) {
            Charge::where('id', $ch)->update(['situation' => 'payed']);
            Charge::where('id', $ch)->update(['id_reglement' => $reglement->id]);
        }
        $this->selectedCharges = [];
        $this->selectAll = false;
    }


    public function checkChargeSituation()
    {
        if (count($this->selectedCharges) != 0) {
            foreach ($this->selectedCharges as $ch) {
                $charge = Charge::where('id', $ch)->first();
                $situat = $charge->situation;
                if ($situat === 'payed') {
                    $this->errordAjoutReg = true;
                } else {
                    $this->errordAjoutReg = false;
                }
            }
        } else {
            $this->errordAjoutReg = true;
        }
    }




















    // CHARGE CRUD

    public function editCharge($id)
    {
        $charge = Charge::where('id', $id)->first();
        $this->id_Charge = $charge->id;
        $this->name = $charge->name;
        $this->type = $charge->type;
        $this->bon = $charge->bon;
        $this->prix_ht = $charge->prix_ht;
        $this->tva = $charge->tva;
        $this->QT = $charge->QT;
        $this->prix_TTC = $charge->prix_TTC;
        $this->MTTTC  = $charge->MTTTC;
        $this->id_projet = $charge->id_projet;
        $this->fournisseur_id = $charge->fournisseur_id;
    }

    public function updateCharge()
    {
        $charge = Charge::where('id', $this->id_Charge)->first();
        $charge->name = $this->name;
        $charge->type  = $this->type;
        $charge->bon = $this->bon;
        $charge->prix_ht = $this->prix_ht;
        $charge->tva = $this->tva;
        $charge->QT = $this->QT;
        $charge->prix_TTC = $this->prix_TTC;
        $charge->MTTTC = $this->MTTTC;
        $charge->id_projet  = $this->id_projet;
        $charge->fournisseur_id  = $this->fournisseur_id;
        $charge->save();
        session()->flash('message', 'Charge bien modifer');
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-model');
    }

    public function deleteCharge($id)
    {
        $charge = Charge::where('id', $id)->first();
        $this->id_Charge = $id;
    }
    public function deleteData()
    {
        $charge = Charge::findOrFail($this->id_Charge)->delete();
        session()->flash('message', 'Charge deleted successfully');
        $this->dispatchBrowserEvent('close-model');
    }


    public function  deleteSelected()
    {

        Charge::query()
            ->whereIn('id', $this->selectedCharges)
            ->delete();

        $this->selectedCharges = [];
        $this->selectAll = false;
    }

    public function saveCharge()
    {
        $this->validation();
        $charge = Charge::create([
            'name' => $this->name,
            'type' => $this->type,
            'bon' => $this->bon,
            'prix_ht' => $this->prix_ht,
            'tva' => $this->tva,
            'QT' => $this->QT,
            'prix_TTC' => $this->prix_TTC,
            'MTTTC' => $this->MTTTC,
            'situation' => $this->situation,
            'id_projet' => $this->id_projet,
            'fournisseur_id' => $this->fournisseur_id,
            'id_reglement' => null,
        ]);

        session()->flash('message', 'Charge created successfully');
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-model');
    }


    public $noProjectOrFourniss = false;
    public function buttonAjouter()
    {
        $this->resetInputs();
        $projects = Projet::all();
        $fournisseurs = Fournisseur::all();
        if ($projects->isEmpty() || $fournisseurs->isEmpty()) {
            session()->flash('warning', "Project or fournisseur 's table is null");
            $this->noProjectOrFourniss = true;
        } else {
            $this->noProjectOrFourniss = false;
        }
    }





    public function resetInputs()
    {

        $this->name = "";
        $this->type = "";
        $this->bon  = "";
        $this->prix_ht = "";
        $this->tva = "";
        $this->QT = "";
        $this->prix_TTC = "";
        $this->MTTTC = "";
    }

    public function validation()
    {
        $this->validate([
            'name' => 'required',
            'type' => 'required',
            'bon' => 'required',
            'prix_ht' => 'required',
            'tva' => 'required',
            'QT' => 'required',
            'prix_TTC' => 'required',
            'MTTTC' => 'required',
        ]);
    }





    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedCharges = Charge::pluck('id');
        } else {
            $this->selectedCharges = [];
        }
    }
}
