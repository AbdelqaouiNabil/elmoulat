<?php

namespace App\Http\Livewire;

use App\Models\Depense;
use App\Models\Projet;
use App\Models\Ouvrier;
use App\Models\Retrait;
use App\Models\Caisse;
use Livewire\Component;

use Livewire\WithPagination;
use Livewire\WithFileUploads;

class DepensesList extends Component
{
    use WithFileUpLoads;
    use WithPagination;



    public $id_depense, $id_projet, $id_ouvrier, $date, $description, $Aqui, $type, $montant, $Aouvrier, $nonJustifier, $justifier;
    public $pages = 10;
    public $bulkDisabled = true;
    public $selectedDepenses = [];
    public $selectAll = false;

    public $search = "";
    protected $queryString  = ['search'];

    // reglement
    // public $montant, $date, $methode, $numero_cheque, $id_facture;
    // public $numFacture ;
    // public $errordAjoutReg = false;
    // Method check or Cash


    public function updatedPages(){
        $this->resetPage('new');
    }


    public function render(){
        $this->bulkDisabled = count($this->selectedDepenses) < 1;
        $projets = Projet::all();
        $depenses = Depense::orderBy('id', 'DESC')->paginate($this->pages,['*'],'new');

        return view('livewire.depenses-list',['depenses'=>$depenses, 'projets'=>$projets]);
    }


    // SEARCH FOURNISSEUR OR PROJECT
    // public function searchBy(){
    //     $charges = Charge::orderBy('id', 'DESC')->paginate($this->pages,['*'],'new');
    //     $projets = Projet::all();
    //     foreach($projets as $proj){
    //         $projName = $proj->name;
    //         $projID = $proj->id;
    //         if($projName == $this->search){
    //             $charges = Charge::where('id_projet', $projID )->paginate($this->pages,['*'],'new');
    //         }
    //         break;
    //     }
    //     $fournisseurs = Fournisseur::all();
    //     foreach($fournisseurs as $fourniss){
    //         $fournissName = $fourniss->name;
    //         $fournissID = $fourniss->id;
    //         if($fournissName == $this->search){
    //             $charges = Charge::where('fournisseur_id', $fournissID )->paginate($this->pages,['*'],'new');
    //         }
    //         break;
    //     }
    //     return $charges;
    // }












    // REGLEMENTS

    // method cheque ou non cheque
    // public $optionC = false;
    // public function optionCheque(){
    //     if($this->optionC){
    //         $this->optionC = false;
    //     }else{
    //         $this->optionC = true;
    //     }
    // }

    // public $avecF = false;
    // public function avecFacture(){
    //     if($this->avecF){
    //         $this->avecF = false;
    //     }else{
    //         $this->avecF = true;
    //     }

    // }

    // REGLEMENT CRUD
    // public function addReg(){


    //     // getting the facture's id from facture table
    //     if(!(is_null($this->numFacture))){
    //         $facture = Facture::where('numero', $this->numFacture)->get();
    //         $this->id_facture = $facture[0]->id;
    //     }
    //     if($this->optionC){
    //     $this->methode = 'cheque';
    //     }
    //     else {
    //     $this->methode = 'cash';
    //     }
    //     $this->validate([
    //         'date' => 'required',
    //         'montant' => 'required',
    //     ]);
    //     $reglement = Reglement::create([
    //         'date' =>$this->date,
    //         'montant' => $this->montant,
    //         'methode' => $this->methode,
    //         'numero_cheque' => $this->numero_cheque,
    //         'id_facture' => $this->id_facture,
    //         'id_contrat' => null,
    //         ]);

    //     // update check situation
    //     Cheque::where('numero', $this->numero_cheque)->update(['situation' => 'livré']);
    //     session()->flash('message', 'Reglement added successfully');
    //     $this->resetInputs();
    //     $this->updateChargeAfterReg();
    //     $this->dispatchBrowserEvent('close-model');
    // }



    // public function updateChargeAfterReg(){
    //     foreach($this->selectedCharges as $ch){
    //         Charge::where('id',$ch)->update(['situation'=> 'payed']);
    //     }
    //     $this->selectedCharges = [];
    //     $this->selectAll = false;
    // }



    // public function checkChargeSituation(){
    //     if(count($this->selectedCharges) != 0){
    //         foreach($this->selectedCharges as $ch){
    //             $charge = Charge::where('id', $ch)->first();
    //             $situat = $charge->situation;
    //             if ($situat === 'payed'){
    //                 $this->errordAjoutReg = true;
    //             }
    //             else{
    //                 $this->errordAjoutReg = false;
    //             }
    //         }
    //     }
    // }









    // DEPENSE CRUD

    public function editDepense($id){
        $depense = Depense::where('id',$id)->first();
        $this->id_depense = $depense->id;
        $this->montant= $depense->montant;
        $this->type = $depense->type;
        $this->date = $depense->date;
        $this->id_projet = $depense->id_projet;
        $this->description = $depense->description;
        $this->Aqui = $depense->Aqui;
        // $this->id_ouvrier = $depense->id_ouvrier ;

}

    public function updateDepense(){
        $depense = Depense::where('id',$this->id_depense)->first();
        $depense->montant = $this->montant;
        $depense->date  = $this->date ;
        $depense->Aqui = $this->Aqui;
        $depense->type = $this->type;
        $depense->id_projet = $this->id_projet;
        $depense->description = $this->description;
        // $depense->id_ouvrier = $this->id_ouvrier;
        $depense->save();
        session()->flash('message','depense bien modifer');
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-model');

}

    public function deleteDepense($id){
        $this->id_depense = $id;
    }
    public function deleteData(){
        Depense::findOrFail($this->id_depense)->delete();
        session()->flash('message', 'Depense deleted successfully');
        $this->dispatchBrowserEvent('close-model');
}


    public function deleteSelected(){

        Depense::query()
            ->whereIn('id',$this->selectedDepenses)
            ->delete();

        $this->selectedDepenses = [];
        $this->selectAll = false;

}

    public function saveDepense(){
        $this->validation();
        if($this->Aouvrier){
            $ouvrier = Ouvrier::where('n_cin', $this->Aqui)->first();
            $this->id_ouvrier = $ouvrier->id;
        }
        if($this->nonJustifier){
            $this->type = 'Non Justifier';
        }else{
            $this->type = 'Justifier';
        }
        $depense = Depense::create([
            'montant' => $this->montant,
            'Aqui' => $this->Aqui,
            'type' => $this->type,
            'date' => $this->date,
            'id_projet' => $this->id_projet,
            'description' => $this->description,
            'id_ouvrier' => $this->id_ouvrier,
        ]);
        $this->id_depense= $depense->id;
        $this->UpdateCaisse();
        session()->flash('message', 'Depense created successfully');
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-model');
}

    public function resetInputs(){
        $this->montant = "";
        $this->Aqui = "" ;
}

    public function validation(){
        $this->validate([
        'montant'=>'required',
        'Aqui'=>'required',
        'date'=>'required',
   ]);
}


    public function updatedSelectAll($value){
        if($value){
            $this->selectedDepenses = Depense::pluck('id');
        }else{
            $this->selectedDepenses = [];
        }
}

    // on this function i will add a new record on table 'RETRAIT' then update the Caisse's sold
    public function UpdateCaisse(){
        $projet = Projet::where('id', $this->id_projet)->first();
        $caisse = Caisse::where('id', $projet->id_caisse)->first();
        Retrait::create([
            'montant'=>$this->montant,
            'date'=>$this->date,
            'id_depense' => $this->id_depense,
            'id_caisse' => $caisse->id,
            'id_reglement' => null
        ]);
        if($this->type == 'Justifier'){
            $caisse->sold = ($caisse->sold)-($this->montant);
            $caisse->total = (($caisse->sold) + ($caisse->sold_nonjustify));
            $caisse->save();
        }else{
            $caisse->sold_nonjustify = ($caisse->sold_nonjustify)-($this->montant);
            $caisse->total = (($caisse->sold_nonjustify) + ($caisse->sold));
            $caisse->save();
        }
}




}
