<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use App\Models\Bank;

class BankList extends Component
{
    public $nomDeBanque , $email , $phone ,$adress, $ville;
    public $rules =[
        'nomDeBanque' => 'required',
        'email' => 'required|email',
        'phone' => 'required|numeric',
    ];


    public function resetInputs(){
        $this->nomDeBanque = "";
        $this->email = "";
        $this->phone = "";
        $this->adress = "";
        $this->ville = "";
    }

    public function saveData(){
       $this->validate();

       dd($ths->nomDeBanque);
    }
    public function render()
    {
        $banks = Bank::all();
        return view('livewire.settings.bank-list',['banks'=>$banks]);
    }
}
