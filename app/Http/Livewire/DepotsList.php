<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Depot;
use App\Models\Caisse;
use App\Models\Cheque;

class DepotsList extends Component
{



    public $id_Depot, $numero_cheque, $dateC, $montant, $id_caisse;

    public $pages = 10;
    public $bulkDisabled = true;
    public $selectedDepots = [];
    public $selectAll = false;



    public function updatedPages()
    {
        $this->resetPage('new');
    }

    public function render()
    {
        $this->bulkDisabled = count($this->selectedDepots) < 1;
        $depots = Depot::orderBy('id', 'DESC')->paginate($this->pages, ['*'], 'new');
        $caisses = Caisse::all();
        return view('livewire.depots-list', ['depots' => $depots, 'caisses' => $caisses]);
    }


    public function saveDepot()
    {
        $this->validation();
        if (!is_null($this->numero_cheque)) {
            if ($this->getCheque($this->numero_cheque)) {
                Depot::create([
                    'numero_cheque' => $this->numero_cheque,
                    'id_caisse' => $this->id_caisse,
                    'dateC' => $this->dateC,
                    'montant' => $this->montant
                ]);
                session()->flash('message', 'depot created successfully');
                $this->augmenteCaisse($this->id_caisse);
                $this->resetInputs();
                $this->dispatchBrowserEvent('close-model');
            } else {
                session()->flash('error', 'error on numero cheque');
            }
        }
    }


    public function resetInputs()
    {
        $this->numero_cheque = "";
        $this->montant = "";
        $this->dateC = "";
        $this->id_caisse = "";
    }
    public function validation()
    {
        $this->validate([
            'numero_cheque' => 'required',
            'montant' => 'required',
            'dateC' => 'required',
            'id_caisse' => 'required'
        ]);
    }


    public function deleteDepot($id)
    {
        $this->id_Depot = $id;
    }
    public function deleteData()
    {
        $this->updateCaisseAfterDelete();
        Depot::findOrFail($this->id_Depot)->delete();
        session()->flash('message', 'depot deleted successfully');
        $this->dispatchBrowserEvent('close-model');
    }


    public function  deleteSelected()
    {
        Depot::query()
            ->whereIn('id', $this->selectedDepots)
            ->delete();

        $this->selectedDepots = [];
        $this->selectAll = false;
    }




    public function editDepot($id)
    {
        $depot = Depot::where('id', $id)->first();
        $this->id_Depot = $depot->id;
        $this->montant = $depot->montant;
        $this->numero_cheque = $depot->numero_cheque;
        $this->dateC = $depot->dateC;
        $this->id_caisse = $depot->id_caisse;
    }

    public function updateDepot()
    {
        if (!is_null($this->numero_cheque)) {
            if ($this->getCheque($this->numero_cheque)) {
                $depot = Depot::where('id', $this->id_Depot)->first();
                $depot->montant = $this->montant;
                $depot->id_caisse  = $this->id_caisse;
                $depot->dateC = $this->dateC;
                $depot->numero_cheque = $this->numero_cheque;
                $depot->save();
                session()->flash('message', 'depot bien modifer');
                $this->resetInputs();
                $this->dispatchBrowserEvent('close-model');
            } else {
                session()->flash('error', 'error on numero cheque');
            }
        }
    }



    // see whether the numero_cheque is in the table cheques or no
    public function getCheque($numcheque)
    {
        $cheque = Cheque::where('numero', $numcheque)->first();
        if (is_null($cheque)) {
            return false;
        } else {
            if($cheque-> situation != 'disponible'){
                return true;
            }
        }
    }

    public function augmenteCaisse($idCaisse){
        $caisse = Caisse::where('id', $idCaisse)->first();
        //update soldNonJustifier
        $caisse->sold_nonjustify = $caisse->sold_nonjustify + $this->montant;
        $caisse->total = (($caisse->sold) + ($caisse->sold_nonjustify));
        $caisse->save();
    }

    public function updateCaisseAfterDelete(){
        $depot = Depot::where('id', $this->id_Depot)->first();
        $caisse = Caisse::where('id', $depot->id_caisse)->first();
        //update soldNonJustifier
        $caisse->sold_nonjustify = $caisse->sold_nonjustify - $depot->montant;
        $caisse->total = (($caisse->sold) + ($caisse->sold_nonjustify));
        $caisse->save();
    }



    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedDepots = Depot::pluck('id');
        } else {
            $this->selectedDepots = [];
        }
    }
}
