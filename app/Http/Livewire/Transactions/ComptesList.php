<?php

namespace App\Http\Livewire\Transactions;

use Livewire\Component;
use App\Models\Compte;

class ComptesList extends Component
{
    public $selectedComptes = false;
    public $numeroDeCompte , $compteID , $soldDeCompte , $dateDeCreation , $bankID ;
    public $bulkDisabled = true;
    public $selectedCompteID = [];
    public $rules = [
        'numeroDeCompte'=> 'required',
    ];

    public function saveData(){



    
    }
    public function render()
    {
        $comptes=Compte::all();
        return view('livewire.transactions.comptes-list',['comptes'=>$comptes]);
    }
}
