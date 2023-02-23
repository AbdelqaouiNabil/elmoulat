<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contrat;
use App\Models\Ouvrier;
use App\Models\Projet;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class ContratsList extends Component
{


    use WithFileUpLoads;
    use WithPagination;

    public $id_contrat, $name, $datedebut, $cin_Ouv, $datefin, $montant, $avance, $id_ouvrier, $ouvrierCIN, $id_projet, $projectNAME;
    public $selectedContrats = [];
    public $pages = 10;
    public $bulkDisabled = true;
    public $selectAll = false;

    public $search;


    public function updatedPages()
    {
        $this->resetPage('new');
    }


    //  public $numberOfPaginatorsRendered = [];
    public function render()
    {
        // $this->numberOfPaginatorsRendered[] = 1;
        $this->bulkDisabled = count($this->selectedContrats) < 1;
        $contrats = Contrat::latest()->paginate($this->pages, ['*'], 'new');
        $ouvriers = Ouvrier::all();
        $projects = Projet::all();

        if ($this->search != "") {
            $contrats = Contrat::where('cin_Ouv', 'like', '%' . $this->search . '%')
                ->orWhere('datedebut', 'like', '%' . $this->search . '%')
                ->orWhere('name', 'like', '%' . $this->search . '%')->paginate($this->pages, ['*'], 'new');
        }

        return view('livewire.owner.contrats-list', ["contrats" => $contrats, "ouvriers" => $ouvriers, "projects"=>$projects]);
    }

    public function editContrat($id)
    {
        $contrat = Contrat::where('id', $id)->first();
        $this->id_contrat = $contrat->id;
        $this->name = $contrat->name;
        $this->datedebut = $contrat->datedebut;
        $this->datefin = $contrat->datefin;
        $this->montant = $contrat->montant;
        $this->avance = $contrat->avance;
        $this->cin_Ouv = $contrat->cin_Ouv;
        // $ouvrier = Ouvrier::where('id', $contrat->id_ouvrier)->first();
        // $this->ouvrierCIN = $ouvrier->n_cin;
        $projet = Projet::where('id', $contrat->id_projet)->first();
        if(!is_null($projet)){
            $this->projectNAME = $projet->name;
            $this->id_projet = $projet->id;
        }

    }
    public function updateContrat()
    {
        $ouvrier = Ouvrier::where('n_cin', $this->cin_Ouv)->first();
        $projet = Projet::where('id', $this->id_projet)->first();

        if (!is_null($ouvrier) && !is_null($projet)) {
            $this->id_ouvrier = $ouvrier->id;

            // update contrat
            $contrat = Contrat::where('id', $this->id_contrat)->first();
            $contrat->name = $this->name;
            $contrat->datedebut  = $this->datedebut;
            $contrat->datefin = $this->datefin;
            $contrat->montant = $this->montant;
            $contrat->avance = $this->avance;
            $contrat->id_ouvrier = $this->id_ouvrier;
            $contrat->id_projet = $this->id_projet;
            $contrat->cin_Ouv = $this->cin_Ouv;
            $contrat->save();
            session()->flash('message', 'Contrat bien modifer');
            $this->resetInputs();
            $this->dispatchBrowserEvent('close-model');
        }
        else{
            session()->flash('error', 'error on Ouvrier Cin ou Projet');
        }
    }

    public function deleteContrat($id)
    {
        $this->id_contrat = $id;
    }

    public function deleteData()
    {
        Contrat::findOrFail($this->id_contrat)->delete();
        session()->flash('message', 'contrat deleted successfully');
        $this->dispatchBrowserEvent('close-model');
    }

    public function  deleteSelected()
    {

        Contrat::query()
            ->whereIn('id', $this->selectedContrats)
            ->delete();

        $this->selectedContrats = [];
        $this->selectAll = false;
    }

    public function saveContrat()
    {
        $this->validation();
        $ouvrier = Ouvrier::where('n_cin', $this->cin_Ouv)->first();
        $projet = Projet::where('id', $this->id_projet)->first();
        if (!is_null($ouvrier) && !is_null($projet)) {
            $this->id_ouvrier = $ouvrier->id;
            $contrat = Contrat::create([
                'name' => $this->name,
                'datedebut' => $this->datedebut,
                'datefin' => $this->datefin,
                'montant' => $this->montant,
                'avance' => $this->avance,
                'cin_Ouv' => $this->cin_Ouv,
                'id_ouvrier' => $this->id_ouvrier,
                'id_projet' => $this->id_projet
            ]);
            session()->flash('message', 'contrat created successfully');
            $this->resetInputs();
            $this->dispatchBrowserEvent('close-model');
        } else {
            session()->flash('error', 'Ouvrier or Projet does not exist');
            // $this->dispatchBrowserEvent('close-model');
        }
    }





    public function resetInputs()
    {

        $this->name = "";
        $this->datedebut = "";
        $this->datefin  = "";
        $this->montant = "";
        $this->avance = "";
        $this->cin_Ouv = "";
        $this->id_projet = "";
    }

    public function validation()
    {
        $this->validate([
            'name' => 'required',
            'datedebut' => 'required',
            'datefin' => 'required',
            'montant' => 'required',
            'avance' => 'required',
            'cin_Ouv' => 'required',
            'id_projet' => 'required',
        ]);
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedContrats = Contrat::pluck('id');
        } else {
            $this->selectedContrats = [];
        }
    }
}
