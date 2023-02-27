<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Charge;


class Dashboard extends Component
{
    public function render()
    {
        $chargeNonPayer = Charge::where('situation','notPayed')->get();
        $chargePayer = Charge::where('situation','Payed')->get();
        return view('livewire.owner.dashboard',[
            'chargeNonPayer'=>$chargeNonPayer,
        ]);
    }
}
