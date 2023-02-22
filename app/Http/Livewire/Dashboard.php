<?php

namespace App\Http\Livewire;
use App\Models\Projet;
use App\Models\Caisse;
use App\Models\Fournisseur;
use App\Models\Charge;
use App\Models\Depense;
use App\Models\Depot;
use App\Models\Retrait;
use App\Models\Compte;
use Livewire\Component;

class Dashboard extends Component
{
    public $currentTab = 'home';



    public function render()
    {
        return view('livewire.dashboard', [
            'currentTab' => $this->currentTab
        ]);
    }

    public function changeTab($tab)
    {
        $this->currentTab = $tab;
    }


    



}
