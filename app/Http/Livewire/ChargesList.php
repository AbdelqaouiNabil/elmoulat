<?php

namespace App\Http\Livewire;

use File;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\Charge;
use App\Models\Projet;
use App\Models\Cheque;
use App\Models\Fournisseur;
use App\Models\Reglement;
use App\Models\Facture;
use App\Models\Retrait;
use App\Models\Caisse;
use Carbon\Carbon;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class ChargesList extends Component
{
    use WithFileUpLoads;
    use WithPagination;

    public $id_Charge, $name, $date, $ref_med, $ref_virement, $montant, $montant_cheque, $cheque_pdf, $bonpdf, $dateR, $fournisseur_id, $id_projet, $id_caisse, $caisse_sold, $type,
    $bon, $prixht, $tva, $QT, $prix_TTC, $MTTTC, $situation, $calculateMontant, $startdate, $enddate;
    public $search;

    public $methode = "cheque";
    public $checkIfnotPayed = false;
    public $pages = 5;
    public $bulkDisabled = true;
    public $selectedCharges = [];
    public $selectAll = false;
    public $filter_date = false;
    public $sortname = "id";
    public $sortdrection = "DESC";
    public $montantArray = [];
    public $numero_cheque, $id_facture;
    public $numFacture;
    public $errordAjoutReg = true;
    // Method check or Cash


    public function updatedPages()
    {
        $this->resetPage('new');
    }

    public $chargetype = ["Administration", "Aluminium", "Ascenseur", "Béton", "Branchement", "Brique", "Bureautique", "Carrelage", "Ciment", "Climatisation", "Concassore	", "Divers", "Entretien", "Fer", "Ferronnerie", "Gravette", "Grillage", "Honoraire", "Hourdis", "Marbre", "Matériel cuisine", "Matériel électricité", "Matériel Plomberie", "Menuiserie", "MO carrelage", "MO chef chantier", "MO construction", "MO divers", "MO Electricité", "MO Gardiennage", "MO Ménage et Nettoyage", "MO Peinture", "MO plâtre", "MO Plomberie", "Parquet", "Peinture", "Pointe", "Poutrelle", "Sable", "Sanitaire", "Signalisation et publicité", "Taxe et impôt", "Terrain", "Transport et véhicule",];
    public function render()
    {


        $this->bulkDisabled = count($this->selectedCharges) < 1;
        $fournisseurs = Fournisseur::all();
        $projets = Projet::all();
        $caisses = Caisse::all();
        $cheques = Cheque::where('situation', 'disponible')->get();


        if ($this->filter_date == true && $this->startdate!="" && $this->enddate!="") {
            $charges = Charge::whereBetween('date', [$this->startdate ,$this->enddate] )
            ->orderBy($this->sortname, $this->sortdrection)
            ->paginate($this->pages, ['*'], 'new');
        } else {
            $charges = Charge::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('situation', 'like', '%' . $this->search . '%')
                ->orWhereHas('fournisseur', function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('projet', function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                })
                ->orderBy($this->sortname, $this->sortdrection)
                ->paginate($this->pages, ['*'], 'new');
        }
        return view('livewire.owner.charges-list', ['charges' => $charges, 'fournisseurs' => $fournisseurs, 'projets' => $projets, 'cheques' => $cheques, 'caisses' => $caisses]);
    }

    public function sort($value)
    {
        if ($this->sortname == $value && $this->sortdrection == "DESC") {
            $this->sortdrection = "ASC";
        } else {
            if ($this->sortname == $value && $this->sortdrection == "ASC") {
                $this->sortdrection = "DESC";
            }
        }
        $this->sortname = $value;

    }



    // REGLEMENTS


    public function ajouterReglement()
    {
        $this->resetInputs();
        $this->dateR = date('Y-m-d');
        $this->montant = Charge::whereIn('id', $this->selectedCharges)->sum('montant');

    }

    // REGLEMENT CRUD

    public function saveReglement()
    {


        if ($this->methode == "cheque") {
            $this->validate([
                'dateR' => 'required|date',
                'montant' => 'required|regex:/^\d*(\.\d{2})?$/',
                'montant_cheque' => 'required|regex:/^\d*(\.\d{2})?$/',
                'numero_cheque' => 'required|exists:cheques,numero,situation,disponible',
                'cheque_pdf' => 'required|mimes:pdf',
            ]);
            $cheque = Cheque::where('numero', $this->numero_cheque)->first();
            $cheque->montant = $this->montant_cheque;
            $cheque->situation = "livrer";
            $cheque->type = "charge";
            $cheque->update();

            $this->cheque_pdf = $this->cheque_pdf->store('Documents/Reglement/cheques', 'public');
            $reglement = new Reglement();
            $reglement->dateR = $this->dateR;
            $reglement->montant = $this->montant;
            $reglement->methode = $this->methode;
            $reglement->numero_cheque = $this->numero_cheque;
            $reglement->ref_med = $this->ref_med;
            $reglement->ref_virement = $this->ref_virement;
            $reglement->cheque_pdf = $this->cheque_pdf;
            $valide = $reglement->save();
        } elseif ($this->methode == "cach") {
            $this->validate([
                'dateR' => 'required|date',
                'montant' => 'required|regex:/^\d*(\.\d{2})?$/',
                'id_caisse' => 'required',
            ]);


            $reglement = new Reglement();
            $reglement->dateR = $this->dateR;
            $reglement->montant = $this->montant;
            $reglement->methode = $this->methode;
            $valide = $reglement->save();
            $retrait = new Retrait();
            $retrait->montant = $this->montant;
            $retrait->dateRet = date('Y-m-d');
            $retrait->id_caisse = $this->id_caisse;
            $retrait->id_reglement = $reglement->id;
            $valide = $retrait->save();
            $caisse = Caisse::where('id', $this->id_caisse)->first();
            $caisse->sold_nonjustify -= $this->montant;
            $valide = $caisse->update();

        } elseif ($this->montant == "virement") {
            $this->validate([
                'dateR' => 'required|date',
                'montant' => 'required|regex:/^\d*(\.\d{2})?$/',
                'ref_virement' => 'required',
            ]);
            $reglement = new Reglement();
            $reglement->dateR = $this->dateR;
            $reglement->montant = $this->montant;
            $reglement->methode = $this->methode;
            $reglement->ref_virement = $this->ref_virement;
            $valide = $reglement->save();
        } elseif ($this->methode = "med") {
            $this->validate([
                'dateR' => 'required|date',
                'montant' => 'required|regex:/^\d*(\.\d{2})?$/',
                'ref_med' => 'required',
            ]);
            $reglement = new Reglement();
            $reglement->dateR = $this->dateR;
            $reglement->montant = $this->montant;
            $reglement->methode = $this->methode;
            $reglement->ref_med = $this->ref_med;
            $valide = $reglement->save();
        }
        if ($valide) {
            Charge::whereIn('id', $this->selectedCharges)->update(['situation' => 'payed']);
            session()->flash('message', 'reglement bien ajouter');
        } else {
            session()->flash('error', 'invalide data');

        }
        $this->selectedCharges = [];
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-model');

    }


    // on this function i will add a new record on table 'RETRAIT' then update the Caisse's sold AFTER THE SAVE DEPENSE
    public $ceProjet, $cetteCaisse;
    public function UpdateCaisseAfterSave($regId)
    {
        //   get all the charge that has this saved reg
        $charge = Charge::where('id_reglement', $regId)->first();
        if (!is_null($charge)) {
            $this->ceProjet = Projet::where('id', $charge->id_projet)->first();
            if (!is_null($this->ceProjet)) {
                $this->cetteCaisse = Caisse::where('id', $this->ceProjet->id_caisse)->first();
                if (!is_null($this->cetteCaisse)) {
                    Retrait::create([
                        'montant' => $this->montant,
                        'dateRet' => $this->dateR,
                        'id_depense' => null,
                        'id_caisse' => $this->cetteCaisse->id,
                        'id_reglement' => null
                    ]);
                    $this->cetteCaisse->sold = ($this->cetteCaisse->sold) - ($this->montant);
                    $this->cetteCaisse->total = (($this->cetteCaisse->sold) + ($this->cetteCaisse->sold_nonjustify));
                    $this->cetteCaisse->save();
                }
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


    public function checkChargeBeforeAddReg()
    {
        // $this->dateR = date('Y.m.d');
        if ($this->selectedCharges) {
            // for checking whether they have the same project id
            $chargeAComparer = Charge::where('id', $this->selectedCharges[0])->first();
            $this->montant = Charge::whereIn('id', $this->selectedCharges)->sum('MTTTC');
            foreach ($this->selectedCharges as $ch) {
                $charge = Charge::where('id', $ch)->first();
                $situat = $charge->situation;
                if ($situat === 'payed') {
                    $this->errordAjoutReg = true;
                    session()->flash('warning2', 'impossible de cree un reglement a une charge deja paye');
                } else {

                    if ($charge->id_projet != $chargeAComparer->id_projet) {
                        $this->errordAjoutReg = true;
                        session()->flash('warning2', 'les charges ne sont pas apartier au meme projet');
                    } else {

                        $this->errordAjoutReg = false;
                    }
                }
            }
        } else {

            $this->errordAjoutReg = true;
        }

    }
    // CHARGE CRUD
    public function editCharge($id)
    {
        $this->resetInputs();
        $charge = Charge::where('id', $id)->first();
        $this->id_Charge = $id;
        $this->name = $charge->name;
        $this->type = $charge->type;
        $this->bon = $charge->bon;
        $this->montant = $charge->montant;
        $this->date = $charge->date;
        $this->id_projet = $charge->id_projet;
        $this->fournisseur_id = $charge->fournisseur_id;
    }

    public function updateCharge()
    {
        $this->validate([
            'name' => 'required',
            'type' => 'required',
            'bon' => 'required',
            'bonpdf' => 'mimes:pdf',
            'date' => 'required|date',
            'montant' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'fournisseur_id' => 'required',
            'id_projet' => 'required',
        ]);

        $charge = Charge::where('id', $this->id_Charge)->first();
        if ($this->bonpdf) {
            $path = Storage::disk('local')->url($charge->bonpdf);
            File::delete(public_path($path));
            $charge->bonpdf = $this->bonpdf->store('Documents/charge/bon', 'public');
        }
        $charge->name = $this->name;
        $charge->type = $this->type;
        $charge->bon = $this->bon;
        $charge->montant = $this->montant;
        $charge->date = $this->date;
        $charge->id_projet = $this->id_projet;
        $charge->fournisseur_id = $this->fournisseur_id;
        $valide = $charge->save();
        if ($valide) {
            session()->flash('message', 'Charge bien modifer');

        } else {
            session()->flash('error', 'invalide data of charge');
        }
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-model');
    }

    public $impossibleDeSupp = false;
    public function deleteCharge($id)
    {
        $charge = Charge::where('id', $id)->first();

        if ($charge->id_reglement != null) {
            session()->flash('warningDelete', "ce charge a deja un reglement !!! nous vous suggérons de supprimer le règlement en premier.");
            $this->impossibleDeSupp = true;
        }
        // $this->id_Charge = $id;
    }
    public function deleteData()
    {
        $charge = Charge::findOrFail($this->id_Charge)->delete();
        session()->flash('message', 'Charge deleted successfully');
        $this->dispatchBrowserEvent('close-model');
    }
    public function deleteSelected()
    {

        Charge::query()
            ->whereIn('id', $this->selectedCharges)
            ->delete();

        $this->selectedCharges = [];
        $this->selectAll = false;
    }
    // for calcalte montant when the user typing inside inputs 
    public function updatedQT()
    {
        if (is_numeric($this->tva) && is_numeric($this->prixht) && is_numeric($this->QT)) {
            $this->montant = (($this->prixht * ($this->tva * 0.01)) + $this->prixht) * $this->QT;
        }
    }
    public function updatedTva()
    {
        if (is_numeric($this->tva) && is_numeric($this->prixht) && is_numeric($this->QT)) {
            $this->montant = (($this->prixht * ($this->tva * 0.01)) + $this->prixht) * $this->QT;
        }
    }
    public function updatedPrixht()
    {
        if (is_numeric($this->tva) && is_numeric($this->prixht) && is_numeric($this->QT)) {
            $this->montant = (($this->prixht * ($this->tva * 0.01)) + $this->prixht) * $this->QT;
        }
    }
    public function saveCharge()
    {
        if ($this->calculateMontant) {

            $this->validate([
                'name' => 'required',
                'type' => 'required',
                'bon' => 'required',
                'bonpdf' => 'required|mimes:pdf',
                'date' => 'required|date',
                'montant' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'fournisseur_id' => 'required',
                'id_projet' => 'required',
                'prixht' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'QT' => 'required|integer',
                'tva' => 'required|regex:/^\d+(\.\d{1,2})?$/',

            ]);
            $this->montant = (($this->prixht * ($this->tva * 0.01)) + $this->prixht) * $this->QT;
        } else {
            $this->validate([
                'name' => 'required',
                'type' => 'required',
                'bon' => 'required',
                'bonpdf' => 'required|mimes:pdf',
                'date' => 'required|date',
                'montant' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'fournisseur_id' => 'required',
                'id_projet' => 'required',

            ]);
        }

        $pdf = $this->bonpdf->store('Documents/charge/bon', 'public');
        $charge = Charge::create([
            'name' => $this->name,
            'type' => $this->type,
            'bon' => $this->bon,
            'bonpdf' => $pdf,
            'date' => $this->date,
            'montant' => $this->montant,
            'id_projet' => $this->id_projet,
            'fournisseur_id' => $this->fournisseur_id,
            'id_reglement' => null,
        ]);
        if ($charge) {
            session()->flash('message', 'Charge created successfully');

        } else {
            session()->flash('error', 'invalide data');
        }

        $this->resetInputs();
        $this->dispatchBrowserEvent('close-model');
    }


    public function resetInputs()
    {

        $this->name = "";
        $this->type = "";
        $this->bon = "";
        $this->bonpdf = "";
        $this->prixht = "";
        $this->date = date('Y-m-d');
        $this->QT = "";
        $this->montant = "";
        $this->tva = "";
        $this->ref_med = "";
        $this->ref_virement = "";
        $this->tva = "";
        $this->dateR = "";
        $this->montant_cheque = "";
        $this->id_caisse = "";
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedCharges = Charge::pluck('id');

        } else {
            $this->selectedCharges = [];
            $this->errordAjoutReg = true;
        }
    }

    public function updatedSelectedCharges()
    {
        $charge = Charge::whereIn('id', $this->selectedCharges)->where('situation', 'payed')->get();
        $this->checkIfnotPayed = (count($charge) > 0) ? false : true;
        if ($this->checkIfnotPayed == false) {
            session()->flash('error', 'Error: you selected payed charge');
        }

    }
    //   for filtter by date 
    public function filterbydate($value)
    {
        $this->filter_date = $value;
       

    }


}