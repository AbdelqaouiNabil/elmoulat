<?php

namespace App\Http\Livewire;

use App\Models\Cheque;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ChequeList extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $situation, $id_cheque, $autre;
    public $search;
    public $selectRows = [];
    public $selectAll = false;
    public $bulkDisabled = true;
    public $pages = 9;
    public $sortname = "id";
    public $sortdrection = "DESC";
    protected $listeners = ['saveData' => 'saveData'];

    public function render()
    {
       $situationCheques=Cheque::query('select situation from cheque groupby(situation)')->get();
        $cheques = Cheque::where('numero', 'like', '%' . $this->search . '%')
            ->orWhere('situation', 'like', '%' . $this->search . '%')->orderBy($this->sortname, $this->sortdrection)->paginate($this->pages, ['*'], 'new');
        return view('livewire.cheque-list', ['cheques' => $cheques,'situationCheques'=>$situationCheques]);
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
            'situation' => 'required',

        ]);
    }
    // this function for reset inputs
    public function resetInputs()
    {
        $this->situation = "";
        $this->autre = "";

    }


    //save data function

    // edit data of a row 
    public function edit($id)
    {
        $cheque = Cheque::where('id', $id)->first();
        $this->id_cheque = $id;
        $this->situation = $cheque->situation;
        if ($cheque->situation == 'autre') {
            $this->situation = $cheque->situation;
            $this->autre = $cheque->situation;
        }
    }

    public function editData()
    {
        $this->validate([
            'situation'=>'required'
        ]);
        if($this->situation=='autre'){
            $this->validate([
                'autre'=>'required'
            ]);
        }
        $cheque = Cheque::where('id', $this->id_cheque)->first();

        if ($cheque->situation == 'disponible') {
            $cheque->situation = $this->situation;
            if($this->situation=='autre'){
            $cheque->situation = $this->autre;
            }
            $cheque->update();
            session()->flash('message', 'cheque bien modifer');
            $this->dispatchBrowserEvent('close-model');
            $this->resetInputs();
        } else {
            session()->flash('error', 'you can\'t update this cheque');
            $this->dispatchBrowserEvent('close-model');
        }
    }



}