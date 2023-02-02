<?php

namespace App\Http\Livewire\Transactions;

use Livewire\Component;
use App\Models\Chequier;
use App\Models\Cheque;
use App\Models\Compte;
use Livewire\WithPagination;

class ChequierList extends Component
{

    use WithPagination;


    public $chequierID,$dateMiseEnDisposition,$nombreDeDebut,$nombreDeFin;
    public $search = "";
    protected $queryString  = ['search'];
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
   public function resetInputs(){
    $this->chequierID = "";
    $this->dateMiseEnDisposition ="";
    $this->nombreDeDebut ="" ;
    $this->nombreDeFin = "";
    $this->compte_id ="" ;
   }

//SAVE CHEQUIER START
    public function saveData(){

       
        $this->validate();

        $chequier = new Chequier;
        $chequier->dateDeMiseEnDisposition = $this->dateMiseEnDisposition;
        $chequier->numeroDeDebut = $this->nombreDeDebut;
        $chequier->numeroDeFin = $this->nombreDeFin;
        $chequier->id_compte = $this->compte_id;
        $chequier->nombreDeCheque = ($this->nombreDeFin - $this->nombreDeDebut) + 1 ;
        $validate = $chequier->save();
       for ($i=0; $i < ($this->nombreDeFin - $this->nombreDeDebut)+1; $i++) { 
        $cheques[] = new Cheque([
            'numero' => $this->nombreDeDebut + $i     ,
            'date' => $this->dateMiseEnDisposition,
            'situation' => 'disponible',
            'id_chequier'=> $chequier->id,
        ]);

       }
       $allChequeAdded = $chequier->cheque()->saveMany($cheques);

       if($validate && $allChequeAdded){

        session()->flash('success','Chequier ajoutern avec succée');
       }else{
        session()->flash('error',"Une erreur s'est produite. Veuillez réessayer ");
       }
       
       // for hidden the model after adding the project
       $this->dispatchBrowserEvent('close-model');
       $this->resetInputs();

    }

    // SAVE CHEQUIER END

    public function deleteChequier($id){
        $chequier = Chequier::where('id',$id)->first();
         $this->chequierID = $chequier->id ;
        
        
    }

    public function deleteData(){
        $chequier = Chequier::where('id', $this->chequierID)->first();
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
         $this->nombreDeDebut =$chequier->numeroDeDebut ;
         $this->nombreDeFin = $chequier->numeroDeFin ;
         $this->compte_id = $chequier->id_compte ;

    }

    public function editData(){
        $chequier = Chequier::where('id',$this->chequierID )->first();
        $chequier->dateDeMiseEnDisposition = $this->dateMiseEnDisposition;
        $chequier->id_compte = $this->compte_id;
        $updated = $chequier->save();
         
       if($updated){

        session()->flash('success','Chequier modifier avec succée');
        $this->dispatchBrowserEvent('close-model');
        
       }else{
        session()->flash('error',"Une erreur s'est produite. Veuillez réessayer ");
        $this->dispatchBrowserEvent('close-model');
       }
     }



// delete selected Chequierc START
     public function  deleteSelected(){
       $chequier = Chequier::whereIn('id',$this->selectedChequier)->delete();
       $cheque = Cheque::whereIn('id_chequier',$this->selectedChequier)->delete();
       if($chequier && $cheque){
        session()->flash('success','Chequier Supprimer avec succée');
        $this->selectedChequier = [];
        $this->selectAll = false;
        $this->bulkDisabled=true;
       }else{
        session()->flash('error',"Une erreur s'est produite. Veuillez réessayer ");
       
       }
       
   
   }
   public function updatedSelectAll($value){
    if($value){
        $this->selectedChequier = Chequier::pluck('id');
    }else{
        $this->selectedChequier= [];
        $this->bulkDisabled=true;
    }
    }
    
// delete selected Chequierc END



    public function render()
    { 
        $this->bulkDisabled = count($this->selectedChequier) < 1;
        $comptes = Compte::all();
        $chequier = Chequier:: where('numeroDeDebut', 'like', '%'.$this->search.'%')
        ->orWhere('dateDeMiseEnDisposition', 'like', '%'.$this->search.'%')->paginate($this->Chequierpage);
      
        return view('livewire.transactions.chequier-list',
        [
        'comptes'=>$comptes,
        'chequier'=> $chequier,
    ]);
    }
}