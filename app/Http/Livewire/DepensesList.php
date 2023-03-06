<?php

namespace App\Http\Livewire;

use App\Models\Cheque;
use App\Models\Depense;
use App\Models\Projet;
use App\Models\Ouvrier;
use App\Models\Retrait;
use App\Models\Caisse;
use Illuminate\Routing\Middleware\ThrottleRequestsWithRedis;
use Livewire\Component;

use Livewire\WithPagination;
use Livewire\WithFileUploads;

class DepensesList extends Component
{
    use WithFileUpLoads;
    use WithPagination;


    public $depenseInfos;
    public $id_depense, $id_project, $id_ouvrier, $id_caisse, $dateDep, $description, $Aqui, $type, $montant, $Aouvrier, $nonJustifier, $justifier, $cin_ouvrier, $autre_type, $type_depense, $numero_cheque,$ref_virement,$description_data, $checkIfnotJustify;
    public $pages = 10;
    public $type_caisse = "sold_nonJustify";
    public $methode = "cach";
    public $bulkDisabled = true;
    public $selectedDepenses = [];
    public $selectAll = false;

    public $search = "";
    protected $queryString = ['search'];
    public $montantBeforeUpdate;
    public $typeDepense = ["Autre", "Ouvrier", "Personnel et charges sociales", "Equipements et matériel", "Entretien et aménagement", "bureautique et documentations", "Produit sanitaires et nettoyage", "Eau et électricité", "Service communication", "Transport et Véhicules", "Déplacements", "missions et réceptions", "Location", "Honoraires & Services", "Assurances", "Frais et Agios bancaire", "Impôts, taxes, Pénalités et amendes", "Prelevement Echance XXXX", "Dons", "Divers", "Lot Terrain", "Lot Construction", "Lot Eau et Plomberie", "Lot Menuiserie", "Lot Ferronnerie", "Lot Electricité", "Lot Platerie", "Lot Carreaux et marbre", "Lot Peinture", "Lot Climatisation", "Lot Administration", "Lot architecture, Ingénierie et études", "Lot gardiennage et divers", "Lot Ascenseur", "Lot signalisation et publicité"];

    public $filter;

    public function updatedPages()
    {
        $this->resetPage('new');
    }


    public function render()
    {
        $this->bulkDisabled = count($this->selectedDepenses) < 1;
        $projets = Projet::all();
        $caisses = Caisse::all();
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

        return view('livewire.owner.depenses-list', ['depenses' => $depenses, 'projets' => $projets, 'caisses' => $caisses]);
    }




    public function showDepense($id)
    {
        
        $this->depenseInfos = Depense::where('id', $id)->first();
        $this->id_depense = $this->depenseInfos->id;
        $this->montant = $this->depenseInfos->montant;
        $this->dateDep = $this->depenseInfos->dateDep;
        $this->description = $this->depenseInfos->description;
        $this->Aqui = $this->depenseInfos->Aqui;
        $this->type = $this->depenseInfos->type;
        $this->id_projet = $this->depenseInfos->id_projet;
    }

    public function editDepense($id)
    {
        $depense = Depense::where('id', $id)->first();
        $this->id_depense = $depense->id;
        $this->montant = $depense->montant;
        $this->dateDep = $depense->dateDep;
        $this->description = $depense->description;
        $this->type_depense = $depense->type_depense;
        $this->autre_type = $depense->type_depense;
        $this->methode = $depense->methode;
        $this->numero_cheque = $depense->numero_cheque;
        $this->id_project = $depense->id_project;

    }

    public function updateDepense()
    {
        $this->validation();
        if ($this->Aouvrier) {
            $ouvrier = Ouvrier::where('n_cin', $this->Aqui)->first();
            if (!is_null($ouvrier)) {
                $this->id_ouvrier = $ouvrier->id;
            }
        }
        $depense = Depense::where('id', $this->id_depense)->first();
        $depense->montant = $this->montant;
        $depense->dateDep = $this->dateDep;
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
        if ($this->methode == "cheque") {
            $this->validate([
                'montant' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'numero_cheque' => 'required|exists:cheques,numero,situation,disponible',
                'dateDep' => 'required|date',
                'type_depense' => 'required',
                'autre_type' => 'required_if:type_depense,Autre',
                'cin_ouvrier' => 'required_if:type_depense,Ouvrier|exists:ouvriers,n_cin|nullable',
                'id_project' => 'required',
                'methode' => 'required',
            ]);
            
            // dd('cheque');

            $depense = new Depense();
            $depense->montant = $this->montant;
            $depense->dateDep = $this->dateDep;
            $depense->description = $this->description;
            $depense->id_project = $this->id_project;
            $depense->situation = 'Non Justify';
            $depense->methode = $this->methode;
            $depense->type_depense = ($this->type_depense == "Autre") ? $this->autre_type : $this->type_depense;
            $depense->id_ouvrier = ($this->type_depense == "Ouvrier") ? Ouvrier::where('n_cin', $this->cin_ouvrier)->pluck('id')->first() : null;
            $valide = $depense->save();
            if ($valide) {
                $cheque = Cheque::where('numero', $this->numero_cheque)->first();
                $cheque->situation = 'livrer';
                $cheque->type = 'depense';
                $valide = $cheque->update();
            }
        }
        elseif ($this->methode == "cach") {
            $this->validate([
                'montant' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'dateDep' => 'required|date',
                'type_depense' => 'required',
                'autre_type' => 'required_if:type_depense,Autre',
                'cin_ouvrier' => 'required_if:type_depense,Ouvrier|exists:ouvriers,n_cin|nullable',
                'id_project' => 'required',
                'methode' => 'required',
                'id_caisse' => 'required',
                'type_caisse' => 'required',
            ]);
            
            $depense = new Depense();
            $depense->montant = $this->montant;
            $depense->dateDep = $this->dateDep;
            $depense->description = $this->description;
            $depense->id_project = $this->id_project;
            $depense->situation = ($this->type_caisse == "sold_nonJustify") ? 'Non Justify' : 'justify';
            $depense->methode = $this->methode;
            $depense->type_depense = ($this->type_depense == "Autre") ? $this->autre_type : $this->type_depense;
            $depense->id_ouvrier = ($this->type_depense == "Ouvrier") ? Ouvrier::where('n_cin', $this->cin_ouvrier)->pluck('id')->first() : null;
            $valide = $depense->save();
            if ($valide) {
                $retrait = new Retrait();
                $retrait->dateRet = date('Y-m-d');
                $retrait->montant = $this->montant;
                $retrait->id_caisse = $this->id_caisse;
                $valide = $retrait->save();
                if ($valide) {
                    $caisse = Caisse::where('id', $this->id_caisse)->first();
                    if ($this->type_caisse == "sold_nonJustify") {
                        $caisse->sold_nonJustify -= $this->montant;
                    } else {
                        $caisse->sold -= $this->montant;
                    }
                    $valide = $caisse->update();
                }
            }


        }elseif($this->methode=="virement"){

        }


        if ($valide) {
            session()->flash('message', 'Depense created successfully');
            $this->dispatchBrowserEvent('add');

        } else {
            session()->flash('error', 'invalide data');
        }
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
    // for show discription inside modal 
    public function Description($id){
        $this->description_data=Depense::where('id',$id)->pluck('description')->first();
    }
    // 
    public function updatedSelectedDepenses()
    {
        $depense = Depense::whereIn('id', $this->selectedDepenses)->where('situation', 'Justify')->get();
        $this->checkIfnotJustify = (count($depense) > 0) ? false : true;
        if ($this->checkIfnotJustify == false) {
            session()->flash('error', 'Error: you selected Justify Depense');
        }
    }
}