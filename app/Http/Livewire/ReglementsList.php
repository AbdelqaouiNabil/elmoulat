<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Facture;
use App\Models\Contrat;
use App\Models\Ouvrier;
use App\Models\Charge;
use App\Models\Projet;
use App\Models\Caisse;
use App\Models\Retrait;
use App\Models\Cheque;
use App\Models\Reglement;
use Exception;
use Livewire\WithPagination;
use Livewire\WithFileUploads;


class ReglementsList extends Component
{
    use WithFileUpLoads;
    use WithPagination;

    public $id_reg, $methode, $montant, $dateR, $numero_cheque, $id_facture, $id_contrat, $num_facture, $optionCheque, $optionFacture;
    public $selectedRegs = [];
    public $pages = 10;
    public $bulkDisabled = true;
    public $selectAll = false;
    public $cin_Ouv, $nom_contrat;

    public $old_numero_cheque, $old_montant;
    public $filter, $search;



    public function updatedPages()
    {
        $this->resetPage('new');
    }


    //  public $numberOfPaginatorsRendered = [];
    public function render()
    {
        $this->bulkDisabled = count($this->selectedRegs) < 1;
        $reglements = Reglement::latest()->paginate($this->pages, ['*'], 'new');
        $factures = Facture::all();

        // FILLTER BY SITUATION PAYED OR NOT PAYED
        switch ($this->filter) {
            case 'cash':
                $reglements = Reglement::where('methode', 'cash')->paginate($this->pages, ['*'], 'new');
                break;
            case 'cheque':
                $reglements = Reglement::where('methode', 'cheque')->paginate($this->pages, ['*'], 'new');
                break;
            default:
                $reglements = Reglement::latest()->paginate($this->pages, ['*'], 'new');
                break;
        }
        if ($this->search != "") {
            $contrat = Contrat::where('cin_Ouv', 'like', '%' . $this->search . '%')->first();
            if (!is_null($contrat)) {
                $reglements = Reglement::where('id_contrat', $contrat->id)
                    ->orWhere('dateR', 'like', '%' . $this->search . '%')->paginate($this->pages, ['*'], 'new');
            } else {
                $reglements = Reglement::where('dateR', 'like', '%' . $this->search . '%')->paginate($this->pages, ['*'], 'new');
            }
        }

        return view('livewire.reglements-list', ["reglements" => $reglements, "factures" => $factures]);
    }















    public function showReglement($id)
    {
        $reg = Reglement::where('id', $id)->first();
        $this->methode = $reg->methode;
        $this->montant = $reg->montant;
        $this->dateR = $reg->dateR;
        $this->numero_cheque = $reg->numero_cheque;
        if (!is_null($reg->id_facture)) {
            $facture = Facture::where('id', $reg->id_facture)->first();
            $this->num_facture = $facture->numero;
        }

        if (!is_null($reg->id_contrat)) {
            $contrat = Contrat::where('id', $reg->id_contrat)->first();
            $this->nom_contrat = $contrat->name;
            $this->cin_Ouv = $contrat->cin_Ouv;
        }
    }




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

    // method facture ou non facture
    public $optionF = false;
    public function optionFacture()
    {
        if ($this->optionF) {
            $this->optionF = false;
        } else {
            $this->optionF = true;
        }
    }










    public function editReglement($id)
    {
        $reglement = Reglement::where('id', $id)->first();
        $this->id_reg = $reglement->id;
        $this->dateR = $reglement->dateR;
        $this->montant = $reglement->montant;
        $this->methode = $reglement->methode;
        $this->numero_cheque = $reglement->numero_cheque;
        if (!is_null($reglement->id_facture)) {
            $facture = Facture::where('id', $reglement->id_facture)->first();
            if (!is_null($facture)) {
                $this->num_facture = $facture->numero;
            }
        }
        if (!is_null($reglement->id_contrat)) {
            $contrat = Contrat::where('id', $reglement->id_contrat)->first();
            if (!is_null($contrat)) {
                $this->cin_Ouv = $contrat->cin_Ouv;
            }
        }

        // Save the old cheque numero
        if (!is_null($reglement->numero_cheque)) {
            $this->old_numero_cheque = $reglement->numero_cheque;
        }
    }




    public function updateReglement()
    {
        $this->validation();
        $pass = true;

        if ($this->optionF) {
            $facture = Facture::where('numero', $this->num_facture)->first();
            if (is_null($facture)) {
                session()->flash('error', 'error on numero facture');
                $this->id_facture = "";
                $pass = false;
            } else {
                $this->id_facture = $facture->id;
            }
        } else {
            $this->id_facture = null;
        }

        $contrat = Contrat::where('cin_Ouv', $this->cin_Ouv)->first();
        if (is_null($contrat)) {
            session()->flash('error', 'error on ouvrier contrat');
            $this->id_contrat = "";
            $pass = false;
        } else {
            $this->id_contrat = $contrat->id;
        }
        if ($this->optionC) {
            $this->methode = 'cheque';
            $cheque = Cheque::where('numero', $this->numero_cheque)->first();
            if (is_null($cheque)) {
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
            $reglement = reglement::where('id', $this->id_reg)->first();
            $reglement->dateR = $this->dateR;
            $reglement->methode  = $this->methode;
            $reglement->montant = $this->montant;
            $reglement->numero_cheque = $this->numero_cheque;
            $reglement->id_facture = $this->id_facture;
            $reglement->id_contrat = $this->id_contrat;
            $reglement->save();

            //modifier sold
            if ($reglement->methode == "cash") {
                $this->UpdateCaisseAfterUpdate();
            }


            //modifier cheques situations
            $OLDcheque = Cheque::where('numero', $this->old_numero_cheque)->first();
            $OLDcheque->situation = "disponible";
            $OLDcheque->save();
            if (!is_null($reglement->numero_cheque)) {
                $cheque = Cheque::where('numero', $reglement->numero_cheque)->first();
                $cheque->situation = "livrer";
                $cheque->save();
            }
            session()->flash('message', 'reglement bien modifer');
            $this->resetInputs();
            $this->dispatchBrowserEvent('close-model');
        }
    }






    public function deleteReglement($id)
    {
        $this->id_reg = $id;
    }

    public function deleteData()
    {
        $this->updateChargeReg($this->id_reg);

        //update cheque situation
        $reglement = reglement::where('id', $this->id_reg)->first();
        if (!is_null($reglement->numero_cheque)) {
            $cheque = Cheque::where('numero', $reglement->numero_cheque)->first();
            if (!is_null($cheque)) {
                $cheque->situation = "disponible";
                $cheque->save();
            }
        }

        

        Reglement::findOrFail($this->id_reg)->delete();
        session()->flash('message', 'reglement deleted successfully');
        $this->dispatchBrowserEvent('close-model');
    }

    // public function deleteSelected()
    // {
    //     for ($j = 0; $j < count($this->selectedRegs); $j++) {

    //         $reglement = reglement::where('id', $this->selectedRegs[$j])->first();

    //         // update cheque situations
    //         if (!is_null($reglement->numero_cheque)) {
    //             $cheque = Cheque::where('numero', $reglement->numero_cheque)->first();
    //             if (!is_null($cheque)) {
    //                 $cheque->situation = "disponible";
    //                 $cheque->save();
    //             }
    //         }

    //         // update charge situation
    //         $charge = Charge::where('id_reglement', $this->selectedRegs[$j])->get();
    //         for ($i = 0; $i < count($charge); $i++) {
    //             if (!is_null($charge[$i])) {
    //                 $charge[$i]->situation = "notPayed";
    //                 $charge[$i]->id_reglement = null;
    //                 $charge[$i]->save();
    //             }
    //         }
    //     }
    //     reglement::query()
    //         ->whereIn('id', $this->selectedRegs)
    //         ->delete();

    //     $this->selectedRegs = [];
    //     $this->selectAll = false;
    // }

    // update the charges table after deleting the reglement
    public function updateChargeReg($idR)
    {
        $charge = Charge::where('id_reglement', $idR)->get();
        for ($i = 0; $i < count($charge); $i++) {
            if (!is_null($charge[$i])) {
                $charge[$i]->situation = "notPayed";
                $charge[$i]->id_reglement = null;
                $charge[$i]->save();
            }
        }
    }

    public function saveReglement()
    {
        $this->validation();
        $pass = true;

        if ($this->optionF) {
            $facture = Facture::where('numero', $this->num_facture)->first();
            if (is_null($facture)) {
                session()->flash('error', 'error on numero facture');
                $this->id_facture = "";
                $pass = false;
            } else {
                $this->id_facture = $facture->id;
            }
        } else {
            $this->id_facture = null;
        }

        $contrat = Contrat::where('cin_Ouv', $this->cin_Ouv)->first();
        if (is_null($contrat)) {
            session()->flash('error', 'error on ouvrier contrat');
            $this->id_contrat = "";
            $pass = false;
        } else {
            $this->id_contrat = $contrat->id;
        }
        if ($this->optionC) {
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
            $reg = reglement::create([
                'dateR' => $this->dateR,
                'montant' => $this->montant,
                'methode' => $this->methode,
                'numero_cheque' => $this->numero_cheque,
                'id_facture' => $this->id_facture,
                'id_contrat' => $this->id_contrat,
            ]);

            //modifier sold
            if ($reg->methode == "cash") {
                $this->UpdateCaisseAfterSave();
            }



            //modifier cheque situation
            if (!is_null($reg->numero_cheque)) {
                $cheque = Cheque::where('numero', $reg->numero_cheque)->first();
                $cheque->situation = "livrer";
                $cheque->save();
            }
            session()->flash('message', 'reglement created successfully');
            $this->resetInputs();
            $this->dispatchBrowserEvent('close-model');
        }
    }


      // on this function i will add a new record on table 'RETRAIT' then update the Caisse's sold AFTER THE SAVE DEPENSE
      public function UpdateCaisseAfterSave()
      {
          $projet = Projet::where('id', $this->id_projet)->first();
          $caisse = Caisse::where('id', $projet->id_caisse)->first();
          Retrait::create([
              'montant' => $this->montant,
              'dateRet' => $this->dateDep,
              'id_depense' => $this->id_depense,
              'id_caisse' => $caisse->id,
              'id_reglement' => null
          ]);
          if ($this->type == 'Justifier') {
              $caisse->sold = ($caisse->sold) - ($this->montant);
              $caisse->total = (($caisse->sold) + ($caisse->sold_nonjustify));
              $caisse->save();
          } else {
              $caisse->sold_nonjustify = ($caisse->sold_nonjustify) - ($this->montant);
              $caisse->total = (($caisse->sold_nonjustify) + ($caisse->sold));
              $caisse->save();
          }
      }




    public function validation()
    {
        $this->validate([
            'dateR' => 'required',
            'montant' => 'required',
            'cin_Ouv' => 'required',
        ]);
    }



    public $noContrat = false;
    public function buttonAjouter()
    {
        $this->resetInputs();
        $contrats = Contrat::all();
        if ($contrats->isEmpty()) {
            session()->flash('warning', "Contrat's table is null");
            $this->noContrat = true;
        } else {
            $this->noContrat = false;
        }
    }



    public function resetInputs()
    {
        $this->methode = "";
        $this->montant  = "";
        $this->numero_cheque = "";
        $this->num_facture = "";
        $this->cin_Ouv = "";
        $this->dateR = "";
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedRegs = Reglement::pluck('id');
        } else {
            $this->selectedRegs = [];
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
}
