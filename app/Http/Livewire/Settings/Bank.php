<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use App\Models\Bank;

class Bank extends Component
{
    public function render()
    {

        $banks = Bank::all();
        return view('livewire.settings.bank',['banks'=>$banks]);
    }
}
