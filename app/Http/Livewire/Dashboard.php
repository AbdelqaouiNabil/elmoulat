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
use Illuminate\Support\Facades\DB;


class Dashboard extends Component
{
 

    public function render()
    {
        // $caisse = 1;
        // $depots = Depot::where('id_caisse', $caisse)->pluck('id');
        // $retraits = Retrait::where('id_caisse', $caisse)->pluck('id');
        $domaines = DB::select('select count(*) as domaineFois , d.name from fournisseurs f, f_domaines d
        where f.id_fdomaine = d.id group by d.name');
        $projets = Projet::all();
        $fournisseurs = Fournisseur::all();
        $caisse = Caisse::where('id', 1)->first();

        // dd($domaines);
        return view('livewire.owner.dashboard', [
            'domaines'=> $domaines,
            'projets'=> $projets,
            'fournisseurs'=>$fournisseurs,
            'caisse'=> $caisse

        ]);
    }


}
