<?php

namespace App\Http\Livewire\Transactions;

use App\Models\Bank;
use App\Models\Chequier;
use App\Models\Relever_Bancaire;
use Livewire\Component;
use App\Models\Compte;

class ComptesList extends Component
{
   
    use WithFileUploads;
    use WithPagination;
    public $numero, $id_compte, $sold, $datecreation, $bankID;
    public $selectRows = [];
    public $selectAll = false;
    public $bulkDisabled = true;
    public $sortname = "id";
    public $sortdrection = "DESC";
    public $pages = 5;
    protected $listeners = ['saveData' => 'saveData'];

    public function render()
    {
        $this->bulkDisabled = count($this->selectRows) < 1;
        $banks =Bank::all();
        $comptes = Compte::orderBy($this->sortname, $this->sortdrection)->paginate($this->pages, ['*'], 'new');
        return view('livewire.transactions.comptes-list', ['comptes' => $comptes, 'banks'=> $banks]);
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
            'numero' => 'required|regex:/[0-9]*/',
            'sold' => 'required|float',
            'datecreation' => 'required|date',
            'bankId' => 'required|integer',
        ]);
    }
    // this function for reset inputs
    public function resetInputs()
    {
        $this->numero = "";
        $this->sold = "";
        $this->datecreation = "";
        $this->bankID = "";
    }


    //save data function
    public function saveData()
    {
        $this->validate([
            'numero' => 'required|regex:/[0-9]*/',
            'sold' => 'required|float',
            'datecreation' => 'required|date',
            'bankId' => 'required|integer',
        ]);
        $compte = new Compte;
        $compte->numero = $this->numero;
        $compte->date_creation = $this->datecreation;
        $compte->bank_id = $this->bankID;
        $compte->sold = $this->sold;
        $c=$compte->save();
        if($c){
        session()->flash('message', 'compte bien ajouter');
        $this->resetInputs();

        $this->dispatchBrowserEvent('add');
        // for hidden the model
        $this->dispatchBrowserEvent('close-model');
        } else{
        session()->flash('error', 'error');
        }

        


    }
    // edit data of a row 
    public function edit($id)
    {
        $compte = compte::where('id', $id)->first();
        $this->bankID = $id;
        $this->numero = $compte->numero;
        $this->datecreation = $compte->date_creation;
        $this->sold = $compte->sold;
    }

    public function editData()
    {

        $this->validate([
            'numero' => 'required|regex:/[0-9]*/',
            'sold' => 'required|float',
            'datecreation' => 'required|date',
            'bankId' => 'required|integer',
        ]);
        $compte = Compte::where('id', $this->bankID)->first();
        $compte->numero = $this->numero;
        $compte->date_creation = $this->datecreation;
        $compte->sold = $this->sold;
        $compte->bank_id = $this->bankID;
        $c=$compte->save();
        if($c){
        session()->flash('message', 'compte updated');
        $this->resetInputs();
        $this->dispatchBrowserEvent('add');
        $this->dispatchBrowserEvent('close-model');
        } else{
        session()->flash('error', 'error');
        }
    }


    // delete data row 

    public function delete($id)
    {
        $compte = Compte::where('id', $id)->first();
        $this->bankID = $id;

    }

    public function deleteData()
    {
        $chequier = Chequier::where('id_compte', $this->id_compte)->first();
        $releverbancaire = Chequier::where('compte_id', $this->id_compte)->first();
        if ($chequier || $releverbancaire) {
            session()->flash('error', 'this compte is aready used  as ForingKey');
            return;
        } else {
             $compte = Compte::where('id', $this->bankID)->delete();
           if($compte){
            session()->flash('message', 'les compte bien supprimer');
            $this->resetInputs();
            $this->dispatchBrowserEvent('add');
            $this->dispatchBrowserEvent('close-model');
           }
           else{
            session()->flash('error', 'this compte is aready used  as ForingKey');

           }
           
        }

    }

    // delete selected rows on the table 
    public function deleteSelectedRows()
    {

        foreach ($this->selectRows as $r) {
            $check = Employe::where('compte_id', $r)->first();
            $check2 = Projet::where('id_compte', $r)->first();
            if ($check || $check2) {
                session()->flash('error', 'You selected an compte aready used  as ForingKey');
                return;
            } else {
                $compte = compte::where('id', $r)->first();
                $compte->delete();
                session()->flash('message', 'les Congés bien supprimer');
                $this->resetInputs();
                $this->dispatchBrowserEvent('add');
            }
        }

        $chequier = Chequier::whereIn('compte_id', $this->selectRows)->get();
        $releverbancaire = Relever_Bancaire::whereIn('id_compte', $this->selectRows)->get();

        if(count($chequier)>0 || count($releverbancaire)>0){
            session()->flash('error', "this compte use as a foreign key  ");

        }else{
            $compte = Compte::whereIn('id', $this->selectRows)->delete();
            if($compte){
            session()->flash('message', 'compte Supprimer avec succée');
            $this->selectRows = [];
            $this->selectAll = false;
            $this->bulkDisabled = true;
            }else{
            session()->flash('error', "this chequier use as a foreign key  ");
                     
            }
        }
    }


    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectRows = compte::pluck('id');
        } else {
            $this->selectRows = [];
        }
    }
}