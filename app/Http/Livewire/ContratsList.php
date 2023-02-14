<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contrat;
use App\Models\Ouvrier;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class ContratsList extends Component
{


    use WithFileUpLoads;
    use WithPagination;

    public $id_contrat, $name, $datedebut, $datefin, $montant, $avance, $id_ouvrier, $ouvrierCIN;
    public $selectedContrats = [];
    public $pages = 10;
    public $bulkDisabled = true;
    public $selectAll = false;



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
        return view('livewire.contrats-list', ["contrats" => $contrats, "ouvriers" => $ouvriers]);
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
        $this->id_ouvrier = $contrat->id_ouvrier;
        $ouvrier = Ouvrier::where('id', $contrat->id_ouvrier)->first();
        $this->ouvrierCIN = $ouvrier->n_cin;
    }
    public function updateContrat()
    {
        $ouvrier = Ouvrier::where('n_cin', $this->ouvrierCIN)->first();
        $this->id_ouvrier = $ouvrier->id;
        $contrat = Contrat::where('id', $this->id_contrat)->first();
        $contrat->name = $this->name;
        $contrat->datedebut  = $this->datedebut;
        $contrat->datefin = $this->datefin;
        $contrat->montant = $this->montant;
        $contrat->avance = $this->avance;
        $contrat->id_ouvrier = $this->id_ouvrier;
        $contrat->save();
        session()->flash('message', 'Contrat bien modifer');
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-model');
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
        $ouvrier = Ouvrier::where('n_cin', $this->ouvrierCIN)->first();
        if (!is_null($ouvrier)) {
            $this->id_ouvrier = $ouvrier->id;
            $this->validation();
            $contrat = Contrat::create([
                'name' => $this->name,
                'datedebut' => $this->datedebut,
                'datefin' => $this->datefin,
                'montant' => $this->montant,
                'avance' => $this->avance,
                'id_ouvrier' => $this->id_ouvrier,
            ]);
            session()->flash('message', 'contrat created successfully');
            $this->resetInputs();
            $this->dispatchBrowserEvent('close-model');
        } else {
            session()->flash('error', 'Ouvrier does not exist');
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
        $this->ouvrierCIN = "";
    }

    public function validation()
    {
        $this->validate([
            'name' => 'required',
            'datedebut' => 'required',
            'datefin' => 'required',
            'montant' => 'required',
            'avance' => 'required',
            'ouvrierCIN' => 'required'
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
