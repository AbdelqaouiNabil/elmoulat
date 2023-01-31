<?php

namespace App\Http\Livewire;
use App\Models\Projet;
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
