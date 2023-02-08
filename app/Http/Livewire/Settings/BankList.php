<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use App\Models\Bank;
use App\Models\Compte;
use \Illuminate\Database\QueryException;


class BankList extends Component
{
    public $nomDeBanque , $banqueID , $email , $phone ,$adress, $ville;
    public $bulkDisabled = true;
    public $selectedBankID = [];
    public $selectAllBanks = false;
   
   
    //   validation real -time
    public function updated($fields){
        $this->validateOnly($fields,[
            'nomDeBanque' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
        ]);
    }


    // reset inputs value
    public function resetInputs(){
        $this->nomDeBanque = "";
        $this->email = "";
        $this->phone = "";
        $this->adress = "";
        $this->ville = "";
    }

    //  add bank function start

    public function saveData(){
       $this->validate([
        'nomDeBanque' => 'required',
        'email' => 'required|email',
        'phone' => 'required|numeric',
       ]);
       $banque = new Bank ;
       $banque->nom = $this->nomDeBanque;
       $banque->email = $this->email;
       $banque->phone = $this->phone;
       $banque->adress = $this->adress;
       $banque->ville = $this->ville;
       $banqueAdded = $banque->save();
       if($banque){
        session()->flash('message','banque bien ajouter');
        // for empty input fields after validation
        $this->resetInputs();
        // for hidden the model
        $this->dispatchBrowserEvent('close-model');

       }else{
        session()->flash('error',"Une erreur s'est produite. Veuillez réessayer ");
        $this->dispatchBrowserEvent('close-model');
       }
      
    }

    //  add bank function end

    public function editBank($id){
        $bank = Bank::where('id',$id)->first();
        $this->banqueID = $bank->id;
        $this->nomDeBanque = $bank->nom;
        $this->email = $bank->email;
        $this->phone = $bank->phone;
        $this->adress = $bank->adress;
        $this->ville = $bank->ville;
    }
    public function editData(){
        $banque = Bank::where('id',$this->banqueID)->first();
        $banque->nom = $this->nomDeBanque;
        $banque->email = $this->email;
        $banque->phone = $this->phone;
        $banque->adress = $this->adress;
        $banque->ville = $this->ville;
        $banqueAdded = $banque->save();
        if($banque){
         session()->flash('message','banque bien Modiffier');
        
         // for hidden the model
         $this->dispatchBrowserEvent('close-model');
 
        }else{
         session()->flash('error',"Une erreur s'est produite. Veuillez réessayer ");
         $this->dispatchBrowserEvent('close-model');
        }


    }

    public function deleteBanque($id){
        $bank = Bank::where('id',$id)->first();
        $this->banqueID = $bank->id;
        $this->nomDeBanque = $bank->nom;
        $this->email = $bank->email;
        $this->phone = $bank->phone;
        $this->adress = $bank->adress;
        $this->ville = $bank->ville;
    }
    public function deleteData(){
         $comptes = Compte::all();
         $banque = Bank::where('id',$this->banqueID)->first();
        if(count($comptes) > 0){
            foreach ($comptes as  $compte) {
                if($compte->bank_id == $banque->id){
                    session()->flash('error','this bank is already on used');
            
                    // for hidden the model
                    $this->dispatchBrowserEvent('close-model');
    
                   
            
                }else{
                  $banqueDeleted =  $banque->delete();
                  if($banqueDeleted){
                    session()->flash('message','banque deleted');
            
                      // for hidden the model
                      $this->dispatchBrowserEvent('close-model');
     
                  }else{
                    session()->flash('error',"Une erreur s'est produite. Veuillez réessayer ");
                    $this->dispatchBrowserEvent('close-model');
                  }
                }
            }
    
         
        }
       
    }


     // DELETE SELECTED BANK START
     public function deleteSelected(){
        $banques = Bank::whereIn('id',$this->selectedBankID)->get();
        $comptes = Compte::all();

        if($banques && count($comptes) > 0){
            
                foreach ($comptes as  $compte) {
                    if( in_array($compte->bank_id,$this->selectedBankID)){
                        session()->flash('error','vous avez selectionner une banque déja utilisé');
                
                        // for hidden the model
                        $this->dispatchBrowserEvent('close-model');

                        $this->selectedBankID = [];
        
                       
                
                    }else{
                      $banqueDeleted =  $banques->delete();
                      if($banqueDeleted){
                        session()->flash('message','banque deleted');
                        $this->selectedBankID = [];
                
                          // for hidden the model
                          $this->dispatchBrowserEvent('close-model');
         
                      }else{
                        session()->flash('error',"Une erreur s'est produite. Veuillez réessayer ");
                        $this->dispatchBrowserEvent('close-model');
                      }
                    }
                }
           
            
    
         
        }



     }




    // DELETE SELECTED BANK END
  

    public function updatedSelectAllBanks($value){
        if($value){
            $this->selectedBankID = Bank::pluck('id')->toArray();
        }else{
            $this->selectedBankID = [];
        }
   
    }
   
    
    public function render()
    {
        $this->bulkDisabled = count($this->selectedBankID) < 1;
        $banks = Bank::all();
        return view('livewire.settings.bank-list',['banks'=>$banks]);
    }
}
