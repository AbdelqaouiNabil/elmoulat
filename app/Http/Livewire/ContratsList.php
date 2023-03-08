<?php

namespace App\Http\Livewire;

use App\Models\Avance;
use App\Models\Avence;
use App\Models\Caisse;
use App\Models\Cheque;
use App\Models\Fournisseur;
use App\Models\Reglement;
use App\Models\Retrait;
use Illuminate\Auth\Events\Validated;
use Livewire\Component;
use App\Models\Contrat;
use App\Models\Ouvrier;
use App\Models\Projet;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class ContratsList extends Component
{
    use WithFileUpLoads;
    use WithPagination;
    public $id_contrat,$ice_fournisseur,$titre,$ice_entreprise,$name_entreprise, $numero_cheque, $datedebut,
     $cin_ouvrier,$datefin, $montant, $avance, $id_ouvrier,$type_avance,
     $ouvrierCIN, $id_projet, $id_reglement,$id_caisse, $projectNAME ,$name,
     $chequeListe,$ref_virement,$ref_med,$ciasseListe;
    public $selectedContrats = [];
    public $type_contrat='ouvrier';
    public $type_ouvrier='particulier';
    public $type_caisse='Non Justify';
    public $pages = 10;
    public $bulkDisabled = true;
    public $selectAll = false;
    public $sortname = "id";
    public $sortdrection = "DESC";


    public $search;
    public $methode = 'cach';



    public function updatedPages()
    {
        $this->resetPage('new');
    }


    //  public $numberOfPaginatorsRendered = [];
    public function render()
    {
        // $this->numberOfPaginatorsRendered[] = 1;
        $this->bulkDisabled = count($this->selectedContrats) < 1;
        $contrats = Contrat::latest()->paginate($this->pages, ['*'], 'new');
        $ouvriers = Ouvrier::all();
        $projects = Projet::all();
        $caisses = Caisse::all();
        $cheques=Cheque::where('situation','disponible')->get();
        $this->methode=(count($caisses)==null)? ((count($cheques)==null)? 'virement': 'cheque'):'cach';
        if ($this->search != "") {
            $contrats = Contrat::where('cin_Ouv', 'like', '%' . $this->search . '%')
                ->orWhere('datedebut', 'like', '%' . $this->search . '%')
                ->orWhere('name', 'like', '%' . $this->search . '%')->orderBy($this->sortname,$this->sortdrection)->paginate($this->pages, ['*'], 'new');
        }

        return view('livewire.owner.contrats-list', ["contrats" => $contrats, "ouvriers" => $ouvriers, "projects" => $projects, "caisses" => $caisses,'cheques',$cheques]);
    }
    // sort function  for order data by table head
    public function sort($value)
    {
        if ($this->sortname == $value && $this->sortdrection == "DESC") {
            $this->sortdrection = "ASC";
        } else {
            if ($this->sortname == $value && $this->sortdrection == "ASC") {
                $this->sortdrection = "DESC";
            }
        }
        $this->sortname = $value;

    }

    public function editContrat($id)
    {
        $contrat = Contrat::where('id', $id)->first();
        $this->id_contrat = $contrat->id;
        $this->name = $contrat->name;
        $this->datedebut = $contrat->datedebut;
        $this->datefin = $contrat->datefin;
        $this->montant = $contrat->montant;
        $this->avance = $contrat->avance;
        $this->cin_Ouv = $contrat->cin_Ouv;
        // $ouvrier = Ouvrier::where('id', $contrat->id_ouvrier)->first();
        // $this->ouvrierCIN = $ouvrier->n_cin;
        $projet = Projet::where('id', $contrat->id_projet)->first();
        if (!is_null($projet)) {
            $this->projectNAME = $projet->name;
            $this->id_projet = $projet->id;
        }

    }
    public function updateContrat()
    {
        $this->validate([
            'titre'=>'required',
            'montant'=>'required|regex:/^\d+(\.\d{1,2})?$/',
            'type_contrat'=>'required',
            'cin_Ouv'=>'required|exists:ouvriers,n_cin',
            'datedebut'=>'required|date',
            'datefin'=>'required|date',
        ]);

        if($this->type_ouvrier=="particulier"){
            

            
        }
        // $ouvrier = Ouvrier::where('n_cin', $this->cin_Ouv)->first();
        // $projet = Projet::where('id', $this->id_projet)->first();

        // if (!is_null($ouvrier) && !is_null($projet)) {
        //     $this->id_ouvrier = $ouvrier->id;

        //     // update contrat
        //     $contrat = Contrat::where('id', $this->id_contrat)->first();
        //     $contrat->name = $this->name;
        //     $contrat->datedebut = $this->datedebut;
        //     $contrat->datefin = $this->datefin;
        //     $contrat->montant = $this->montant;
        //     $contrat->avance = $this->avance;
        //     $contrat->id_ouvrier = $this->id_ouvrier;
        //     $contrat->id_projet = $this->id_projet;
        //     $contrat->cin_Ouv = $this->cin_Ouv;
        //     $contrat->save();
        //     session()->flash('message', 'Contrat bien modifer');
        //     $this->resetInputs();
        //     $this->dispatchBrowserEvent('close-model');
        // } else {
        //     session()->flash('error', 'error on Ouvrier Cin ou Projet');
        // }
    }

    public function deleteContrat($id)
    {
        $this->id_contrat = $id;
    }

    public function deleteData()
    {
        Contrat::findOrFail($this->id_contrat)->delete();
        session()->flash('message', 'contrat deleted successfully');
        $this->dispatchBrowserEvent('close-model');
    }

    public function deleteSelected()
    {

        Contrat::query()
            ->whereIn('id', $this->selectedContrats)
            ->delete();

        $this->selectedContrats = [];
        $this->selectAll = false;
    }

    public function saveContrat()
    {
        if($this->type_contrat=="ouvrier"){
            if($this->type_ouvrier=="particulier"){
                $this->validate([
                    'titre'=>'required',
                    'montant'=>'required|regex:/^\d+(\.\d{1,2})?$/',
                    'type_contrat'=>'required',
                    'type_ouvrier'=>'required',
                    'cin_ouvrier'=>'required|exists:ouvriers,n_cin',
                    'datedebut'=>'required|date|before:datefin',
                    'datefin'=>'required|date|after:datedebut',
                ]);
                
                $contrat=new Contrat();
                $contrat->titre=$this->titre;
                $contrat->montant=$this->montant;
                $contrat->datedebut=$this->datedebut;
                $contrat->datefin=$this->datefin;
                $contrat->id_ouvrier=Ouvrier::where('n_cin', $this->cin_ouvrier)->pluck('id')->first();
                $valide=$contrat->save();
            }elseif($this->type_ouvrier=="entreprise"){

                $this->validate([
                    'titre'=>'required',
                    'montant'=>'required|regex:/^\d+(\.\d{1,2})?$/',
                    'type_contrat'=>'required',
                    'type_ouvrier'=>'required',
                    'name_entreprise'=>'required',
                    'ice_entreprise'=>'required|min:13|max:15',
                    'datedebut'=>'required|date|before:datefin',
                    'datefin'=>'required|date|after:datedebut',
                ]);
                $contrat=new Contrat();
                $contrat->titre=$this->titre;
                $contrat->montant=$this->montant;
                $contrat->datedebut=$this->datedebut;
                $contrat->datefin=$this->datefin;
                $contrat->name_entreprise=$this->name_entreprise;
                $contrat->ice_entreprise=$this->ice_entreprise;
                $valide=$contrat->save();
            }
            


        }elseif($this->type_contrat=="fournisseur"){
            $this->validate([
                'titre'=>'required',
                'montant'=>'required|regex:/^\d+(\.\d{1,2})?$/',
                'type_contrat'=>'required',
                'ice_fournisseur'=>'required|exists:fournisseurs,ice',
                'datedebut'=>'required|date|before:datefin',
                'datefin'=>'required|date|after:datedebut',
            ]);
            $contrat=new Contrat();
                $contrat->titre=$this->titre;
                $contrat->montant=$this->montant;
                $contrat->datedebut=$this->datedebut;
                $contrat->datefin=$this->datefin;
                $contrat->id_fournisseur=Fournisseur::where('ice',$this->ice_fournisseur)->pluck('id')->first();
                $valide=$contrat->save();


        }
        
        if ($valide) {
            
            session()->flash('message', 'contrat created successfully');
           
        } else {
            session()->flash('error', 'invalide data');
            // $this->dispatchBrowserEvent('close-model');
        }
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-model');
    }





    public function resetInputs()
    {

        $this->titre = "";
        $this->datedebut = "";
        $this->datefin = "";
        $this->montant = "";
        $this->avance = "";
        $this->type_avance = "";
        $this->type_contrat = "ouvrier";
        $this->type_ouvrier = "particulier";
        $this->id_reglement = "";
        $this->id_contrat = "";
        $this->id_caisse = "";
    }

    // public function validation()
    // {
    //     $this->validate([
    //         'name' => 'required',
    //         'datedebut' => 'required',
    //         'datefin' => 'required',
    //         'montant' => 'required',
    //         'avance' => 'required',
    //         'cin_Ouv' => 'required',
    //         'id_projet' => 'required',
    //     ]);
    // }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedContrats = Contrat::pluck('id');
        } else {
            $this->selectedContrats = [];
        }
    }

    // save data of reglement 
    public function addReglement($id)
    {
        $contrat = Contrat::where('id', $id)->first();
        $this->id_contrat = $id;
        $this->montant = $contrat->montant - $contrat->avance;
        $this->name = $contrat->name;
        $this->methode = 'cheque';
        $this->datedebut = date('Y-m-d');



    }

    public function saveReglement()
    {
        $this->validate([
            'datedebut' => 'required|date',
        ]);
        if ($this->methode == 'cheque') {
            // add zero to left of nuemro cheque
            $this->numero_cheque= strval(str_pad(($this->numero_cheque), 7, '0', STR_PAD_LEFT));
            $this->validate([
                'numero_cheque' => 'required|exists:cheques,numero,situation,disponible',

            ]);
            $reglement = new Reglement();
            $reglement->dateR = $this->datedebut;
            $reglement->methode = $this->methode;
            $reglement->montant = $this->montant;
            $reglement->id_contrat = $this->id_contrat;
            $reglement->numero_cheque = $this->numero_cheque;
            $valide = $reglement->save();
            if($valide){
                $cheque= Cheque::where('numero',$reglement->numero_cheque)->first();
                $cheque->situation='livrer';
                $cheque->update();
            }else{
                session()->flash('error', 'cheque update data invalide  ');

            }

        } else {
            $this->validate([
                'id_caisse' => 'required',

            ]);
            $reglement = new Reglement();
            $reglement->dateR = $this->datedebut;
            $reglement->methode = $this->methode;
            $reglement->montant = $this->montant;
            $reglement->id_contrat = $this->id_contrat;
            $valide = $reglement->save();

            if($valide){
                $retrait=new Retrait();
                $retrait->dateRet= $this->datedebut;
                $retrait->id_caisse= $this->id_caisse;
                $retrait->montant= $reglement->montant;
                $valide=$retrait->save();
                session()->flash('error', 'caisse update data invalide  ');

                if($valide){
                    $caisse=Caisse::where('id', $this->id_caisse)->first();
                    $caisse->sold_nonjustify -=$retrait->montant;
                    $valide=$caisse->update();

                }else{
                    session()->flash('error', 'caisse update data invalide  ');

                }
            }else{
                session()->flash('error', 'Retrait insert data invalide  ');

            }
        }
        if ($valide) {
            $this->dispatchBrowserEvent('close-model');
            $this->dispatchBrowserEvent('add');
        }else{
            session()->flash('error', 'can\'t save this reglement ');
        }
    }

    // add avance 
    public function addAvance($id){
        $this->id_contrat=$id;
        $this->chequeListe=Cheque::where('situation', 'disponible')->get();
        
    }
    public function saveAvance(){
        $this->validate([
            'montant'=>'required|regex:/^\d+(\.\d{1,2})?$/',
            'type_avance'=>'required',
        ]);
        $avance=new Avance();
        $avance->montant=$this->montant;
        $avance->type=$this->type_avance;
        $avance->dateA=date('Y-m-d');
        $valide= $avance->save();
        if ($valide) {
            Contrat::where('id',$this->id_contrat)->update(['avance'=>$this->montant]);
            session()->flash('message', 'avence add succesfully ');
            
        }else{
            session()->flash('error', 'invalide data ');
        }
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-model');
    }
}