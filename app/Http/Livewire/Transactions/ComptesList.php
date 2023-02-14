<?php

namespace App\Http\Livewire\Transactions;

use App\Models\Bank;
use App\Models\Chequier;
use App\Models\Relever_Bancaire;
use Livewire\Component;
use App\Models\Compte;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ComptesList extends Component
{
   
    use WithFileUploads;
    use WithPagination;
    public $numero, $id_compte, $sold, $datecreation, $bankId;
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
            'sold' => 'required|regex:/^\d*(\.\d{2})?$/',
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
        $this->bankId = "";
    }


    //save data function
    public function saveData()
    {
        $this->validate([
            'numero' => 'required|regex:/[0-9]*/',
            'sold' => 'required|regex:/^\d*(\.\d{2})?$/',
            'datecreation' => 'required|date',
            'bankId' => 'required|integer',
        ]);
        $compte = new Compte;
        $compte->numero = $this->numero;
        $compte->date_creation = $this->datecreation;
        $compte->bank_id = $this->bankId;
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
        $this->bankId = $id;
        $this->numero = $compte->numero;
        $this->datecreation = $compte->date_creation;
        $this->sold = $compte->sold;
    }

    public function editData()
    {

        $this->validate([
            'numero' => 'required|regex:/[0-9]*/',
            'sold' => 'required|regex:/^\d*(\.\d{2})?$/',
            'datecreation' => 'required|date',
            'bankId' => 'required|integer',
        ]);
        $compte = Compte::where('id', $this->bankId)->first();
        $compte->numero = $this->numero;
        $compte->date_creation = $this->datecreation;
        $compte->sold = $this->sold;
        $compte->bank_id = $this->bankId;
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
        $this->bankId = $id;

    }

    public function deleteData()
    {
        $chequier = Chequier::where('id_compte', $this->id_compte)->first();
        $releverbancaire = Relever_Bancaire::where('compte_id', $this->compte_id)->first();
        if ($chequier || $releverbancaire) {
            session()->flash('error', 'this compte is aready used  as ForingKey');
            return;
        } else {
             $compte = Compte::where('id', $this->id_compte)->delete();
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

       
    

        $chequier = Chequier::whereIn('id_compte', $this->selectRows)->get();
        $releverbancaire = Relever_Bancaire::whereIn('compte_id', $this->selectRows)->get();

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