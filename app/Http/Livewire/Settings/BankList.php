<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use App\Models\Bank;

class BankList extends Component
{
    public $nomDeBanque , $email , $phone ,$adress, $ville;
   
   
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
        $this->nomDeBanque = $bank->nom;
        $this->email = $bank->email;
        $this->phone = $bank->phone;
        $this->adress = $bank->adress;
        $this->ville = $bank->ville;
    }
    public function render()
    {
        $banks = Bank::all();
        return view('livewire.settings.bank-list',['banks'=>$banks]);
    }
}
