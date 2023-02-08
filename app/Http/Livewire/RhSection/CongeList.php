<?php

namespace App\Http\Livewire\RhSection;

use Livewire\Component;
use App\Models\Employe;
use App\Models\Conge;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Database\QueryException;


class CongeList extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $datedebut, $datefin, $jours, $type, $id_conge, $employe_id,$search;
    public $typeautre;
    public $selectRows = [];
    public $selectAll = false;
    public $bulkDisabled = true;
    public $pages = 5;
    public $sortname = "id";
    public $sortdrection = "DESC";
    protected $listeners = ['saveData' => 'saveData'];

    public function render()
    {
        $this->typeautre = $this->type;

        $this->bulkDisabled = count($this->selectRows) < 1;
        $conges = Conge::where('id', 'like', '%'.$this->search.'%')
        ->orWhere('type', 'like', '%'.$this->search.'%')->orderBy($this->sortname, $this->sortdrection)->paginate($this->pages, ['*'], 'new');
        $employes = Employe::all();
        return view('livewire.rh-section.conge-list', ['conges' => $conges, 'employes' => $employes]);
    }
    // sort function 
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

    // for paginate
    public function updatingPages($value)
    {
        $this->resetPage('new');

    }
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'datedebut' => 'required|date',
            'datefin' => 'required|date',
            'jours' => 'required|integer',
            'employe_id' => 'required|integer',
            'type' => 'required',
        ]);
    }
    // this function for reset inputs
    public function resetInputs()
    {
        $this->datedebut = "";
        $this->datefin = "";
        $this->jours = "";
        $this->employe_id = "";
        $this->type = "";
    }


    //save data function
    public function saveData()
    {
        $this->validate([
            'datedebut' => 'required|date',
            'datefin' => 'required|date',
            'employe_id' => 'required|integer',
            'type' => 'required',

        ]);


        //    calcule lea jours de conge
        $date1 = strtotime($this->datedebut);
        $date2 = strtotime($this->datefin);
        if ($date1 > $date2) {
            session()->flash('form_error', 'date fin most be greter than date debut');
            $this->datedebut = "";
            $this->datefin = "";
            return;
        }
        $nombrejours = (int) (($date2 - $date1) / 86400);

        $conge = new Conge;
        $conge->date_debut = $this->datedebut;
        $conge->date_fin = $this->datefin;
        $conge->jours = $nombrejours;
        $conge->type = $this->type;
        $conge->employe_id = $this->employe_id;

        $conge->save();
        session()->flash('message', 'conge bien ajouter');

        // for empty input fields after validation

        $this->resetInputs();

        $this->dispatchBrowserEvent('add');

        // for hidden the model
        $this->dispatchBrowserEvent('close-model');


    }
    // edit data of a row 
    public function edit($id)
    {
        $conge = Conge::where('id', $id)->first();
        $this->id_conge = $id;
        $this->datedebut = $conge->date_debut;
        $this->datefin = $conge->date_fin;
        $this->employe_id = $conge->employe_id;
        $this->type = $conge->type;
    }

    public function editData()
    {

        $date1 = strtotime($this->datedebut);
        $date2 = strtotime($this->datefin);
        if ($date1 > $date2) {
            session()->flash('form_error', 'la date dubet superieur a la date de fin');
            $this->datedebut = "";
            $this->datefin = "";
            return;
        }
        $nombrejours = (int) (($date2 - $date1) / 86400);
        $conge = Conge::where('id', $this->id_conge)->first();

        $conge->date_debut = $this->datedebut;
        $conge->date_fin = $this->datefin;
        $conge->jours = $nombrejours;
        $conge->type = $this->type;
        $conge->employe_id = $this->employe_id;
        $conge->save();
        session()->flash('message', 'conge bien modifer');
        $this->dispatchBrowserEvent('close-model');
        $this->resetInputs();
    }


    // delete data row 

    public function delete($id)
    {
        $conge = Conge::where('id', $id)->first();
        $this->id_conge = $id;
        
    }

    public function deleteData()
    {
        $conge = Conge::where('id', $this->id_conge)->first();
            $conge->delete();
            session()->flash('message', 'conge bien supprimer');
            $this->dispatchBrowserEvent('add');
            $this->dispatchBrowserEvent('close-model');
            $this->resetInputs();

    }

    // delete selected rows on the table 
    public function deleteSelectedRows()
    {
        $conges = Conge::query()->whereIn('id', $this->selectRows)->delete();
        $conges->delete();
        $this->selectRows = [];
        $this->selectAll = false;
        $this->resetInputs();

    }


    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectRows = conge::pluck('id');
        } else {
            $this->selectRows = [];
        }
    }
}