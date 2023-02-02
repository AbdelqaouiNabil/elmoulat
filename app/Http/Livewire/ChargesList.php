<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Charge;
use App\Models\Projet;
use App\Models\Cheque;
use App\Models\Fournisseur;
use App\Models\Reglement;
use App\Models\Facture;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
class ChargesList extends Component
{
    use WithFileUpLoads;
    use WithPagination;

    public $id_Charge, $name, $fournisseur_id, $id_projet, $type,
    $bon, $prix_ht, $tva, $QT,$prix_TTC, $MTTTC, $situation;
    public $selectedOption;
    public $pages = 10;
    public $bulkDisabled = true;
    public $selectedCharges = [];
    public $selectAll = false;

    // reglement
    public $montant, $date, $methode, $numero_cheque, $id_facture;
    public $numFacture ;
    public $errordAjoutReg = false;
    // Method check or Cash


 public function updatedPages(){
    $this->resetPage('new');
 }


    public function render(){
        $this->bulkDisabled = count($this->selectedCharges) < 1;
        $charges = Charge::orderBy('id', 'DESC')->paginate($this->pages,['*'],'new');
        $fournisseurs = Fournisseur::all();
        $projets = Projet::all();
        $cheques = Cheque::where('situation', 'disponible')->get();
        return view('livewire.charges-list',['charges'=>$charges, 'fournisseurs'=>$fournisseurs, 'projets'=>$projets, 'cheques' => $cheques]);
    }


    // REGLEMENTS

    // method cheque ou non cheque
    public $optionC = false;
    public function optionCheque(){
        if($this->optionC){
            $this->optionC = false;
        }else{
            $this->optionC = true;
        }
    }

    public $avecF = false;
    public function avecFacture(){
        if($this->avecF){
            $this->avecF = false;
        }else{
            $this->avecF = true;
        }

    }

    // REGLEMENT CRUD
    public function addReg(){


        // getting the facture's id from facture table
        if(!(is_null($this->numFacture))){
            $facture = Facture::where('numero', $this->numFacture)->get();
            $this->id_facture = $facture[0]->id;
        }
        if($this->optionC){
        $this->methode = 'cheque';
        }
        else {
        $this->methode = 'cash';
        }
        $this->validate([
            'date' => 'required',
            'montant' => 'required',
        ]);
        $reglement = Reglement::create([
            'date' =>$this->date,
            'montant' => $this->montant,
            'methode' => $this->methode,
            'numero_cheque' => $this->numero_cheque,
            'id_facture' => $this->id_facture,
            'id_contrat' => null,
            ]);

        // update check situation
        Cheque::where('numero', $this->numero_cheque)->update(['situation' => 'livré']);
        session()->flash('message', 'Reglement added successfully');
        $this->resetInputs();
        $this->updateChargeAfterReg();
        $this->dispatchBrowserEvent('close-model');
    }



    public function updateChargeAfterReg(){
        foreach($this->selectedCharges as $ch){
            Charge::where('id',$ch)->update(['situation'=> 'payed']);
        }
        $this->selectedCharges = [];
        $this->selectAll = false;
    }



    public function checkChargeSituation(){
        if(count($this->selectedCharges) != 0){
            foreach($this->selectedCharges as $ch){
                $charge = Charge::where('id', $ch)->first();
                $situat = $charge->situation;
                if ($situat === 'payed'){
                    $this->errordAjoutReg = true;
                }
                else{
                    $this->errordAjoutReg = false;
                }
            }
        }
    }




















    // CHARGE CRUD

    public function editCharge($id){
        $charge = Charge::where('id',$id)->first();
        $this->id_Charge = $charge->id;
        $this->name= $charge->name;
        $this->type = $charge->type;
        $this->bon = $charge->bon;
        $this->prix_ht = $charge->prix_ht;
        $this->tva = $charge->tva;
        $this->QT = $charge->QT ;
        $this->prix_TTC = $charge->prix_TTC ;
        $this->MTTTC  = $charge->MTTTC;
        $this->id_projet = $charge->id_projet;
        $this->fournisseur_id = $charge->fournisseur_id;
    }

    public function updateCharge(){
        $charge = Charge::where('id',$this->id_Charge)->first();
        $charge->name = $this->name;
        $charge->type  = $this->type ;
        $charge->bon = $this->bon;
        $charge->prix_ht = $this->prix_ht;
        $charge->tva = $this->tva;
        $charge->QT = $this->QT;
        $charge->prix_TTC = $this->prix_TTC;
        $charge->MTTTC = $this->MTTTC;
        $charge->id_projet  = $this->id_projet ;
        $charge->fournisseur_id  = $this->fournisseur_id ;
        $charge->save();
        session()->flash('message','Charge bien modifer');
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-model');

    }

    public function deleteCharge($id){
        $charge = Charge::where('id',$id)->first();
        $this->id_Charge = $id;

    }
    public function deleteData(){
        $charge = Charge::findOrFail($this->id_Charge)->delete();
        session()->flash('message', 'Charge deleted successfully');
        $this->dispatchBrowserEvent('close-model');
    }


    public function  deleteSelected(){

        Charge::query()
            ->whereIn('id',$this->selectedCharges)
            ->delete();

        $this->selectedCharges = [];
        $this->selectAll = false;

    }

    public function saveCharge(){
        $this->validation();
        $charge = Charge::create([
            'name' => $this->name,
            'type' => $this->type,
            'bon' => $this->bon,
            'prix_ht' => $this->prix_ht,
            'tva' => $this->tva,
            'QT' => $this->QT,
            'prix_TTC' => $this->prix_TTC,
            'MTTTC' => $this->MTTTC,
            'situation' => $this->situation,
            'id_projet' => $this->id_projet,
            'fournisseur_id' => $this->fournisseur_id,
            'id_reglement' => null,
        ]);

        session()->flash('message', 'Charge created successfully');
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-model');
    }

    public function resetInputs(){

        $this->name = "";
        $this->type = "" ;
        $this->bon  = "";
        $this->prix_ht = "";
        $this->tva = "";
        $this->QT = "";
        $this->prix_TTC = "";
        $this->MTTTC = "";
}

    public function validation(){
        $this->validate([
        'name'=>'required',
        'type'=>'required',
        'bon'=>'required',
        'prix_ht'=>'required',
        'tva' => 'required',
        'QT'=>'required',
        'prix_TTC'=>'required',
        'MTTTC'=>'required',
   ]);

}


public function updatedSelectAll($value){
    if($value){
        $this->selectedCharges = Charge::pluck('id');
    }else{
        $this->selectedCharges = [];
    }
 }



}
