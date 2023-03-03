<?php

namespace App\Http\Livewire;

use App\Models\Depense;
use App\Models\Projet;
use App\Models\Ouvrier;
use App\Models\Retrait;
use App\Models\Caisse;
use Livewire\Component;

use Livewire\WithPagination;
use Livewire\WithFileUploads;

class DepensesList extends Component
{
    use WithFileUpLoads;
    use WithPagination;


    public $depenseInfos;
    public $id_depense, $id_projet, $id_ouvrier, $dateDep, $description, $Aqui, $type, $montant, $Aouvrier, $nonJustifier, $justifier;
    public $pages = 10;
    public $bulkDisabled = true;
    public $selectedDepenses = [];
    public $selectAll = false;

    public $search = "";
    protected $queryString  = ['search'];
    public $montantBeforeUpdate;
    public $typeDepense=["Autre","Personnel et charges sociales","Equipements et matériel","Entretien et aménagement","bureautique et documentations","Produit sanitaires et nettoyage"	,"Eau et électricité","Service communication","Transport et Véhicules"	,"Déplacements", "missions et réceptions","Location","Honoraires & Services","Assurances","Frais et Agios bancaire","Impôts, taxes, Pénalités et amendes","Prelevement Echance XXXX","Dons","Divers","Lot Terrain","Lot Construction","Lot Eau et Plomberie","Lot Menuiserie","Lot Ferronnerie","Lot Electricité","Lot Platerie","Lot Carreaux et marbre","Lot Peinture","Lot Climatisation","Lot Administration","Lot architecture, Ingénierie et études","Lot gardiennage et divers","Lot Ascenseur","Lot signalisation et publicité"];

    public $filter;

    public function updatedPages()
    {
        $this->resetPage('new');
    }


    public function render()
    {
        $this->bulkDisabled = count($this->selectedDepenses) < 1;
        $projets = Projet::all();
        $depenses = Depense::orderBy('id', 'DESC')->paginate($this->pages, ['*'], 'new');

        // FOR THE FILTERING JUSTIFY OR NON JUSTIFY
        switch ($this->filter) {
            case null:
                $depenses = Depense::orderBy('id', 'DESC')->paginate($this->pages, ['*'], 'new');
                break;
            case 'Justifier':
                $depenses = Depense::where('type', 'Justifier')->paginate($this->pages, ['*'], 'new');
                break;
            case 'Non Justifier':
                $depenses = Depense::where('type', 'Non Justifier')->paginate($this->pages, ['*'], 'new');
                break;
            default:
                $depenses = Depense::orderBy('id', 'DESC')->paginate($this->pages, ['*'], 'new');
                break;
        }

        if ($this->search != "") {
            $depenses = Depense::where('Aqui', 'like', '%' . $this->search . '%')->paginate($this->pages, ['*'], 'new');
        }

        return view('livewire.owner.depenses-list', ['depenses' => $depenses, 'projets' => $projets]);
    }
















    // REGLEMENTS

    // method cheque ou non cheque
    // public $optionC = false;
    // public function optionCheque(){
    //     if($this->optionC){
    //         $this->optionC = false;
    //     }else{
    //         $this->optionC = true;
    //     }
    // }

    // public $avecF = false;
    // public function avecFacture(){
    //     if($this->avecF){
    //         $this->avecF = false;
    //     }else{
    //         $this->avecF = true;
    //     }

    // }

    // REGLEMENT CRUD
    // public function addReg(){


    //     // getting the facture's id from facture table
    //     if(!(is_null($this->numFacture))){
    //         $facture = Facture::where('numero', $this->numFacture)->get();
    //         $this->id_facture = $facture[0]->id;
    //     }
    //     if($this->optionC){
    //     $this->methode = 'cheque';
    //     }
    //     else {
    //     $this->methode = 'cash';
    //     }
    //     $this->validate([
    //         'date' => 'required',
    //         'montant' => 'required',
    //     ]);
    //     $reglement = Reglement::create([
    //         'date' =>$this->date,
    //         'montant' => $this->montant,
    //         'methode' => $this->methode,
    //         'numero_cheque' => $this->numero_cheque,
    //         'id_facture' => $this->id_facture,
    //         'id_contrat' => null,
    //         ]);

    //     // update check situation
    //     Cheque::where('numero', $this->numero_cheque)->update(['situation' => 'livré']);
    //     session()->flash('message', 'Reglement added successfully');
    //     $this->resetInputs();
    //     $this->updateChargeAfterReg();
    //     $this->dispatchBrowserEvent('close-model');
    // }



    // public function updateChargeAfterReg(){
    //     foreach($this->selectedCharges as $ch){
    //         Charge::where('id',$ch)->update(['situation'=> 'payed']);
    //     }
    //     $this->selectedCharges = [];
    //     $this->selectAll = false;
    // }



    // public function checkChargeSituation(){
    //     if(count($this->selectedCharges) != 0){
    //         foreach($this->selectedCharges as $ch){
    //             $charge = Charge::where('id', $ch)->first();
    //             $situat = $charge->situation;
    //             if ($situat === 'payed'){
    //                 $this->errordAjoutReg = true;
    //             }
    //             else{
    //                 $this->errordAjoutReg = false;
    //             }
    //         }
    //     }
    // }









    // DEPENSE CRUD


    public function showDepense($id)
    {
        $this->depenseInfos = Depense::where('id', $id)->first();
        $this->id_depense = $this->depenseInfos->id;
        $this->montant = $this->depenseInfos->montant;
        $this->dateDep = $this->depenseInfos->dateDep;
        $this->description = $this->depenseInfos->description;
        $this->Aqui = $this->depenseInfos->Aqui;
        $this->type = $this->depenseInfos->type;
        $this->id_projet =  $this->depenseInfos->id_projet;
    }

    public function editDepense($id)
    {
        $depense = Depense::where('id', $id)->first();
        $this->id_depense = $depense->id;
        $this->montant = $depense->montant;
        $this->dateDep = $depense->dateDep;
        $this->description = $depense->description;
        $this->Aqui = $depense->Aqui;
        $this->montantBeforeUpdate = $depense->montant;
    }

    public function updateDepense()
    {
        $this->validation();
        if ($this->Aouvrier) {
            $ouvrier = Ouvrier::where('n_cin', $this->Aqui)->first();
            if(!is_null($ouvrier)){
                $this->id_ouvrier = $ouvrier->id;
            }
        }
        $depense = Depense::where('id', $this->id_depense)->first();
        $depense->montant = $this->montant;
        $depense->dateDep  = $this->dateDep;
        $depense->Aqui = $this->Aqui;
        $depense->description = $this->description;
        $depense->id_ouvrier = $this->id_ouvrier;
        $depense->save();
        $this->UpdateCaisseAfterUpdate();
        session()->flash('message', 'depense bien modifer');
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-model');
    }

    //     public function deleteDepense($id){
    //         $this->id_depense = $id;
    // }
    //     public function deleteData(){
    //         Depense::findOrFail($this->id_depense)->delete();
    //         session()->flash('message', 'Depense deleted successfully');
    //         $this->dispatchBrowserEvent('close-model');
    // }
    //     public function deleteSelected(){

    //         Depense::query()
    //             ->whereIn('id',$this->selectedDepenses)
    //             ->delete();

    //         $this->selectedDepenses = [];
    //         $this->selectAll = false;
    // }

    public function saveDepense()
    {
        $this->validation();
        if ($this->Aouvrier) {
            $ouvrier = Ouvrier::where('n_cin', $this->Aqui)->first();
            if(!is_null($ouvrier)){
                $this->id_ouvrier = $ouvrier->id;
            }else{
                session()->flash('error', 'Cin Ouvrier est incorrect');
            }
        }
        if ($this->nonJustifier) {
            $this->type = 'Non Justifier';
        } else {
            $this->type = 'Justifier';
        }
        $depense = Depense::create([
            'montant' => $this->montant,
            'Aqui' => $this->Aqui,
            'type' => $this->type,
            'dateDep' => $this->dateDep,
            'id_projet' => $this->id_projet,
            'description' => $this->description,
            'id_ouvrier' => $this->id_ouvrier,
        ]);
        $this->id_depense = $depense->id;

        $this->UpdateCaisseAfterSave();
        session()->flash('message', 'Depense created successfully');
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-model');
    }



    public $noProjects = false;
    public function buttonAjouter()
    {
        $this->resetInputs();
        $projects = Projet::all();
        if ($projects->isEmpty()) {
            session()->flash('warning', "Project's table is null");
            $this->noProjects = true;
        } else {
            $this->noProjects = false;
        }
    }


    public function resetInputs()
    {
        $this->montant = "";
        $this->Aqui = "";
        $this->justifier = false;
        $this->nonJustifier = false;
        $this->dateDep = "";
        $this->Aqui = "";
        $this->description = "";
        $this->Aouvrier = false;
    }

    public function validation()
    {
        $this->validate([
            'montant' => 'required',
            'Aqui' => 'required',
            'dateDep' => 'required',
        ]);
    }


    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedDepenses = Depense::pluck('id');
        } else {
            $this->selectedDepenses = [];
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

    // update Retrait and Caisse after updating the Depense
    public function UpdateCaisseAfterUpdate()
    {
        $dep = Depense::where('id', $this->id_depense)->first();

        // update new record on retrait
        $retrait = Retrait::where('id_depense', $dep->id)->first();
        $retrait->montant = $this->montant;
        $retrait->dateRet = $this->dateDep;
        $retrait->save();

        // update Caisse's sold
        $caisse = Caisse::where('id', $retrait->id_caisse)->first();
        $montantAfterUpdate = ($this->montantBeforeUpdate) - ($this->montant);
        if ($dep->type == "Justifier") {
            $caisse->sold = (($caisse->sold) - ($montantAfterUpdate));
            $caisse->total = (($caisse->sold) + ($caisse->sold_nonjustify));
            $caisse->save();
        } else {
            $caisse->sold_nonjustify = (($caisse->sold_nonjustify) - ($montantAfterUpdate));
            $caisse->total = (($caisse->sold) + ($caisse->sold_nonjustify));
            $caisse->save();
        }
    }
}
