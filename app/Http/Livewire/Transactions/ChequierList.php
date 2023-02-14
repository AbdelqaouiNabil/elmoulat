<?php

namespace App\Http\Livewire\Transactions;

use Carbon\Traits\ToStringFormat;
use Livewire\Component;
use App\Models\Chequier;
use App\Models\Cheque;
use App\Models\Compte;
use Livewire\WithPagination;
use \Illuminate\Database\QueryException;

class ChequierList extends Component
{

    use WithPagination;


    public $chequierID, $dateMiseEnDisposition, $nombreDeDebut, $nombreDeFin;
    public $search = "";
    protected $queryString = ['search'];
    public $Chequierpage = 5;
    public $selectedChequier = [];
    public $bulkDisabled = true;
    public $selectAll = false;
    public $compte_id = 1;
    public $rules = [
        'dateMiseEnDisposition' => 'required|date',
        'nombreDeDebut' => 'required',
        'nombreDeFin' => 'required|gt:nombreDeDebut',
    ];



    // RESET INPUTS VALUE AFTER SAVE
    public function resetInputs()
    {
        $this->chequierID = "";
        $this->dateMiseEnDisposition = "";
        $this->nombreDeDebut = "";
        $this->nombreDeFin = "";
        $this->compte_id = "";
    }

    //SAVE CHEQUIER START
    public function saveData()
    {
          

        $this->validate();

        $chequier = new Chequier;
        $chequier->dateDeMiseEnDisposition = $this->dateMiseEnDisposition;
        $chequier->numeroDeDebut = $this->nombreDeDebut;
        $chequier->numeroDeFin = $this->nombreDeFin;
        $chequier->id_compte = $this->compte_id;
        $chequier->nombreDeCheque = ($this->nombreDeFin - $this->nombreDeDebut) + 1;
        $validate = $chequier->save();
        for ($i = 0; $i < ($this->nombreDeFin - $this->nombreDeDebut) + 1; $i++) {
          
            $cheques[] = new Cheque([
                'numero' => strval(str_pad(($this->nombreDeDebut + $i),7,'0',STR_PAD_LEFT)),
                'date' => $this->dateMiseEnDisposition,
                'situation' => 'disponible',
                'id_chequier' => $chequier->id,
            ]);

        }
        $allChequeAdded = $chequier->cheque()->saveMany($cheques);

        if ($validate && $allChequeAdded) {

            session()->flash('success', 'Chequier ajoutern avec succée');
        } else {
            session()->flash('error', "Une erreur s'est produite. Veuillez réessayer ");
        }

        // for hidden the model after adding the project
        $this->dispatchBrowserEvent('close-model');
        $this->resetInputs();

    }

    // SAVE CHEQUIER END

    public function deleteChequier($id)
    {
        $chequier = Chequier::where('id', $id)->first();
        $this->chequierID = $chequier->id;


    }

    public function deleteData()
    {
        $cheque = Cheque::where('id_chequier', $this->chequierID)->get();
        if (count($cheque) > 0) {
            session()->flash('error', 'this chequier use as a foreign key ');
        } else {
            $v = Chequier::where('id', $this->chequierID)->delete();
            if ($v) {
                session()->flash('success', ' chequier bien supprimer');

            } else {
                session()->flash('error', 'this chequier use as a foreign key ');

            }
        }
        
    }


    public function editChequier($id)
    {
        $chequier = Chequier::where('id', $id)->first();
        $this->chequierID = $chequier->id;
        $this->dateMiseEnDisposition = $chequier->dateDeMiseEnDisposition;
        $this->nombreDeDebut = $chequier->numeroDeDebut;
        $this->nombreDeFin = $chequier->numeroDeFin;
        $this->compte_id = $chequier->id_compte;

    }

    public function editData()
    {
        $chequier = Chequier::where('id', $this->chequierID)->first();
        $chequier->dateDeMiseEnDisposition = $this->dateMiseEnDisposition;
        $chequier->id_compte = $this->compte_id;
        $updated = $chequier->save();

        if ($updated) {

            session()->flash('success', 'Chequier modifier avec succée');
            $this->dispatchBrowserEvent('close-model');

        } else {
            session()->flash('error', "Une erreur s'est produite. Veuillez réessayer ");
            $this->dispatchBrowserEvent('close-model');
        }
    }



    // delete selected Chequierc START
    public function deleteSelected()
    {
        $cheque = Cheque::whereIn('id_chequier', $this->selectedChequier)->get();

        if(count($cheque)>0){
            session()->flash('error', "this chequier use as a foreign key  ");

        }else{
            $chequier = Chequier::whereIn('id', $this->selectedChequier)->delete();
            if($chequier){
            session()->flash('success', 'Chequier Supprimer avec succée');
            $this->selectedChequier = [];
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
            $this->selectedChequier = Chequier::pluck('id');
        } else {
            $this->selectedChequier = [];
            $this->bulkDisabled = true;
        }
    }

    // delete selected Chequierc END



    public function render()
    {
        $this->bulkDisabled = count($this->selectedChequier) < 1;
        $comptes = Compte::all();
        $chequier = Chequier::where('numeroDeDebut', 'like', '%' . $this->search . '%')
            ->orWhere('dateDeMiseEnDisposition', 'like', '%' . $this->search . '%')->paginate($this->Chequierpage);
        return view(
            'livewire.transactions.chequier-list',
            [
                'comptes' => $comptes,
                'chequier' => $chequier,
            ]
        );
    }
}