<?php


namespace App\Http\Livewire;

use App\Models\Cheque;
use App\Models\Projet;
use App\Models\Retrait;
use Livewire\Component;
use App\Models\Caisse;
use App\Models\Depot;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use \Illuminate\Database\QueryException;

class CaisseList extends Component
{

    use WithFileUploads;
    use WithPagination;
    public $name, $sold_nonjustify, $sold, $id_caisse, $total, $numero_cheque, $dateC, $montant, $type_sold;
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
        $caisses = Caisse::orderBy($this->sortname, $this->sortdrection)->paginate($this->pages, ['*'], 'new');
        return view('livewire.caisse-list', ['caisses' => $caisses]);
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
            'name' => 'required',
            'sold' => 'required|regex:/^\d*(\.\d{2})?$/',
            'sold_nonjustify' => 'required|regex:/^\d*(\.\d{2})?$/',
        ]);
    }
    // this function for reset inputs
    public function resetInputs()
    {
        $this->name = "";
        $this->sold = "";
        $this->sold_nonjustify = "";
        $this->total = "";
        $this->id_caisse = "";
        $this->montant = "";
        $this->dateC = "";
        $this->type_sold = "";
        $this->numero_cheque = "";
    }


    //save data function
    public function saveData()
    {
        $this->validate([
            'name' => 'required',
            'sold' => 'required|regex:/^\d*(\.\d{2})?$/',
            'sold_nonjustify' => 'required|regex:/^\d*(\.\d{2})?$/',

        ]);
        $caisse = new Caisse;
        $caisse->name = $this->name;
        $caisse->sold = $this->sold;
        $caisse->sold_nonjustify = $this->sold_nonjustify;
        $caisse->total;

        $valide = $caisse->save();
        if ($valide) {
            session()->flash('message', 'caisse bien ajouter');
            $this->dispatchBrowserEvent('add');
        } else {
            session()->flash('error', 'you can\'t add this caisse please try again');

        }

        // for empty input fields after validation
        $this->resetInputs();
        // for hidden the model
        $this->dispatchBrowserEvent('close-model');


    }
    // edit data of a row 
    public function edit($id)
    {
        $caisse = Caisse::where('id', $id)->first();
        $this->id_caisse = $id;
        $this->name = $caisse->name;
        $this->sold = $caisse->sold;
        $this->sold_nonjustify = $caisse->sold_nonjustify;
    }

    public function editData()
    {

        $this->validate([
            'name' => 'required',
            'sold' => 'required|regex:/^\d*(\.\d{2})?$/',
            'sold_nonjustify' => 'required|regex:/^\d*(\.\d{2})?$/',

        ]);
        $caisse = Caisse::where('id', $this->id_caisse)->first();
        $caisse->name = $this->name;
        $caisse->sold = $this->sold;
        $caisse->sold_nonjustify = $this->sold_nonjustify;
        $caisse->total;

        $valide = $caisse->update();
        if ($valide) {
            session()->flash('message', 'caisse updated succefully');
        } else {
            session()->flash('error', 'you can\'t update this caisse please try again');

        }

        $this->dispatchBrowserEvent('close-model');
        $this->resetInputs();
    }


    // delete data row 

    public function delete($id)
    {
        $this->id_caisse = $id;

    }

    public function deleteData()
    {
        $retrait = Retrait::where('id_caisse', $this->id_caisse)->get();
        $depot = Depot::where('id_caisse', $this->id_caisse)->get();
        if (count($retrait) > 0 || count($depot) > 0) {
            session()->flash('error', 'this caisse is aready used  as ForingKey');
            return;
        } else {
            $caisse = caisse::where('id', $this->id_caisse)->first();
            $caisse->delete();
            session()->flash('message', 'les caisse bien supprimer');
        }
        $this->resetInputs();


    }

    // delete selected rows on the table 
    public function deleteSelectedRows()
    {

        $retrait = Retrait::whereIn('id_caisse', $this->selectRows)->get();
        $depot = Depot::whereIn('id_caisse', $this->selectRows)->get();
        $project = Projet::whereIn('id_caisse', $this->selectRows)->get();

        if (count($retrait) > 0 || count($depot) > 0 || count($project) > 0) {
            session()->flash('error', 'there is a or more caisse is aready used  as ForingKey ');
            return;
        } else {
            $caisse = Caisse::whereIn('id', $this->selectRows);
            $caisse->delete();
            session()->flash('message', 'les caisse bien supprimer');
            $this->selectRows = [];
            $this->selectAll = false;

        }
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-model');



    }


    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectRows = caisse::pluck('id');
        } else {
            $this->selectRows = [];
        }
    }


    // save depot
    public function saveDepot()
    {
        $this->validate([
            'numero_cheque' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'id_caisse' => 'required',
            'dateC' => 'required|date',
            'montant' => 'required|regex:/^\d+(\.\d{1,2})?$/',

        ]);
        $numeroCheque=str_pad(($this->numero_cheque), 7, '0', STR_PAD_LEFT) ;
        $cheque = Cheque::where('numero', $numeroCheque)->get();
        if (count($cheque) > 0 && $cheque->situation == 'disponible') {
            
             
            Depot::create([
                'numero_cheque' => $numeroCheque,
                'id_caisse' => $this->id_caisse,
                'dateC' => $this->dateC,
                'montant' => $this->montant
            ]);
            $caisse = Caisse::where('id', $this->id_caisse)->first();
            if ($this->type_sold == "sold_justify") {
                $caisse->sold = $caisse->sold + $this->montant;
                $caisse->update();

            } else {
                $caisse->sold_nonjustify = $caisse->sold_nonjustify + $this->montant;
                $caisse->update();
            }

            //update Cheque after Adding Depot
            $cheque = Cheque::where('numero', $numeroCheque)->first();
            $cheque->situation = 'livrer';
            $cheque->update();

            session()->flash('message', 'depot created successfully');
            $this->resetInputs();

        } else {
            session()->flash('error', 'number of cheque is rong or is used befor ');
        }
        $this->dispatchBrowserEvent('close-model');

    }
}