<?php

namespace App\Http\Livewire\Transactions;

use Livewire\Component;
use App\Models\Chequier;
use App\Models\Compte;

class ChequierList extends Component
{
    public $chequierID ,$dateMiseEnDisposition,$nombreDeDebut,$nombreDeFin, $totalDesCheques;
    public $compte_id = 1;
    public $rules = [
        'dateMiseEnDisposition' => 'required|date',
        'nombreDeDebut' => 'required',
        'nombreDeFin' => 'required|gt:nombreDeDebut',
    ];


    public function saveData(){

       
        $this->validate();

        $chequier = new Chequier;
        $chequier->dateDeMiseEnDisposition = $this->dateMiseEnDisposition;
        $chequier->numeroDeDebut = $this->nombreDeDebut;
        $chequier->numeroDeFin = $this->nombreDeFin;
        $chequier->id_compte = $this->compte_id;
        $chequier->nombreDeCheque = $this->nombreDeFin - $this->nombreDeDebut ;
       $validate = $chequier->save();
       if($validate){

        session()->flash('success','Chequier ajoutern avec succée');
       }else{
        session()->flash('error',"Une erreur s'est produite. Veuillez réessayer ");
       }

       // for hidden the model after adding the project
       $this->dispatchBrowserEvent('close-model');

    }

    public function deleteChequier($id){
        $chequier = Chequier::where('id',$id)->first();
        $this->chequierID = $chequier->id;
        $this->dateMiseEnDisposition = $chequier->dateDeMiseEnDisposition;
        $this->numeroDeDebut = $chequier->numeroDeDebut;
        $this->numeroDeFin = $chequier->numeroDeFin;
        $this->id_compte = $chequier->compte_id;
        $this->nombreDeCheque = $chequier->nombreDeCheque;
        
    }
    public function deleteData(){
        $chequier = Chequier::where('id',$this->chequierID)->first();
           $deleted = $chequier->delete();
        if($deleted){
            session()->flash('success','Chequier bien supprimer');
            $this->dispatchBrowserEvent('close-model');
        }
    }


    public function editChequier($id){
        $chequier = Chequier::where('id',$id)->first();
        $this->chequierID = $chequier->id;
        $this->dateMiseEnDisposition = $chequier->dateDeMiseEnDisposition;
        $this->numeroDeDebut = $chequier->numeroDeDebut;
        $this->numeroDeFin = $chequier->numeroDeFin;
        $this->id_compte = $chequier->compte_id;
        $this->nombreDeCheque = $chequier->nombreDeCheque;
    }

    public function editData(){
        $chequier = Chequier::where('id',$this->chequierID)->first();
        $this->validate();
        $chequier->dateDeMiseEnDisposition = $this->dateMiseEnDisposition;
        $chequier->numeroDeDebut = $this->nombreDeDebut;
        $chequier->numeroDeFin = $this->nombreDeFin;
        $chequier->id_compte = $this->compte_id;
        $chequier->nombreDeCheque = $this->nombreDeFin - $this->nombreDeDebut ;
       $validate = $chequier->save();
       if($validate){
        session()->flash('success','Chequier modifier avec succée');
       }else{
        session()->flash('error',"Une erreur s'est produite. Veuillez réessayer ");
       }

       // for hidden the model after adding the project
       $this->dispatchBrowserEvent('close-model');
    }




    public function render()
    { 
        $comptes = Compte::all();
        $chequier = Chequier::all();
        
        return view('livewire.transactions.chequier-list',['comptes'=>$comptes,'chequier'=>$chequier]);
    }
}
