<?php

namespace App\Http\Livewire\RhSection;

use Livewire\Component;
use App\Models\Employe;
use App\Models\Bureau;
use App\Models\Conge;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
// use Illuminate\Database\QueryException;

class EmployeList extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $nom, $bureau_id, $prenom, $phone, $datedebut, $datenais, $contrat, $designiation, $salaire, $id_employe;
    public $selectRows = [];
    public $selectAll = false;
    public $bulkDisabled = true;
    public $pages = 5;
    public $sortname = "id";
    public $sortdrection = "DESC";
    public $search;


    public function render()
    {
        $this->bulkDisabled = count($this->selectRows) < 1;
       // $employes = Employe::orderBy($this->sortname, $this->sortdrection)->paginate($this->pages, ['*'], 'new');
        $employes = Employe::where('nom', 'like', '%'.$this->search.'%')
        ->orWhere('prenom', 'like', '%'.$this->search.'%')->orderBy($this->sortname, $this->sortdrection)->paginate($this->pages, ['*'], 'new');
        $bureaus = Bureau::all();
        return view('livewire.rh-section.employe-list', ['employes' => $employes, 'bureaus' => $bureaus]);
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

    // for paginate
    public function updatingPages($value)
    {
        $this->resetPage('new');

    }
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'nom' => 'required',
            'prenom' => 'required',
            'phone' => 'required|integer',
            'datenais' => 'required|date',
            'datedebut' => 'required|date',
            'contrat' => 'required',
            'salaire' => 'required',
            'bureau_id' => 'required|integer',

        ]);
    }
    // this function for reset inputs
    public function resetInputs()
    {
        $this->nom = "";
        $this->prenom = "";
        $this->phone = "";
        $this->datenais = "";
        $this->datedebut = "";
        $this->contrat = "";
        $this->designiation = "";
        $this->bureau_id = "";
        $this->salaire = "";

    }


    //save data function
    public function saveData()
    {
        $this->validate([

            'nom' => 'required',
            'prenom' => 'required',
            'phone' => 'required|integer',
            'datenais' => 'required|date',
            'datedebut' => 'required|date',
            'contrat' => 'required',
            'salaire' => 'required',
            'bureau_id' => 'required|integer',


        ]);
        $employe = new Employe;

        $employe->nom = $this->nom;
        $employe->prenom = $this->prenom;
        $employe->phone = $this->phone;
        $employe->datenais = $this->datenais;
        $employe->datedebut = $this->datedebut;
        $employe->contrat = $this->contrat;
        $employe->salaire = $this->salaire;
        $employe->designiation = $this->designiation;
        $employe->bureau_id = $this->bureau_id;
        $employe->save();
        session()->flash('message', 'employe bien ajouter');

        // for empty input fields after validation

        $this->resetInputs();

        $this->dispatchBrowserEvent('add');

        // for hidden the model
        $this->dispatchBrowserEvent('close-model');


    }
    // edit data of a row 
    public function edit($id)
    {
        $employe = Employe::where('id', $id)->first();
        $this->id_employe = $id;
        $this->nom = $employe->nom;
        $this->prenom = $employe->prenom;
        $this->phone = $employe->phone;
        $this->datenais = $employe->datenais;
        $this->datedebut = $employe->datedebut;
        $this->contrat = $employe->contrat;
        $this->designiation = $employe->designiation;
        $this->bureau_id = $employe->bureau_id;
        $this->salaire = $employe->salaire;


    }

    public function editData()
    {
        $employe = Employe::where('id', $this->id_employe)->first();
        $employe->bureau_id = $this->bureau_id;
        $employe->nom = $this->nom;
        $employe->prenom = $this->prenom;
        $employe->phone = $this->phone;
        $employe->datenais = $this->datenais;
        $employe->datedebut = $this->datedebut;
        $employe->contrat = $this->contrat;
        $employe->salaire = $this->salaire;
        $employe->designiation = $this->designiation;
        $employe->save();
        session()->flash('message', 'employe bien modifer');
        $this->dispatchBrowserEvent('close-model');
    }


    // delete data row 

    public function delete($id)
    {
        $employe = Employe::where('id', $id)->first();
        $this->id_employe = $id;
        $this->nom = $employe->nom;
        $this->prenom = $employe->prenom;
        $this->phone = $employe->phone;
        $this->datenais = $employe->datenais;
        $this->datedebut = $employe->datedebut;
        $this->contrat = $employe->contrat;
        $this->designiation = $employe->designiation;
        $this->bureau_id = $employe->bureau_id;
        $this->salaire = $employe->salaire;
    }

    public function deleteData()
    {
        
        $check= Conge::where('employe_id',$this->id_employe)->first();
        if($check){
            session()->flash('error','le employe used in conges table as ForingKey');
            
        }else {
            $employe = Employe::where('id', $this->id_employe)->first();
            $employe->delete();
            session()->flash('message', 'employe bien supprimer');
            $this->resetInputs();
            $this->dispatchBrowserEvent('add');
        }

    }

    // delete selected rows on the table 
    public function deleteSelectedRows()
    {
        foreach ($this->selectRows as $r) {
            $check = Conge::where('employe_id', $r)->first();
            if ($check) {
                session()->flash('error', 'You selected an employe aready used in conges table as ForingKey');
                return;

            } else {
                $employe = Employe::where('id', $r)->first();
                $employe->delete();
                session()->flash('message', 'les employes bien supprimer');
                $this->resetInputs();
                $this->dispatchBrowserEvent('add');
            }
        }

    }


    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectRows = Employe::pluck('id');
        } else {
            $this->selectRows = [];
        }
    }
}