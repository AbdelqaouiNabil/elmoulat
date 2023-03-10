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
    public $id_contrat, $ice_fournisseur, $titre, $ice_entreprise, $name_entreprise, $numero_cheque, $datedebut,
    $cin_ouvrier, $datefin, $montant, $avance, $id_ouvrier, $type_avance,
    $ouvrierCIN, $id_projet, $id_reglement, $id_caisse, $projectNAME, $name,
    $chequeListe, $ref_virement, $ref_med, $date_avance,$date,$montant_cheque,$cheque_pdf;
    public $selectedContrats = [];

    public $type_contrat = 'ouvrier';
    public $type_ouvrier = 'particulier';
    public $type_caisse = 'Non Justify';
    public $pages = 10;
    public $bulkDisabled = true;
    public $isReglementExists = false;
    public $selectAll = false;
    public $sortname = "id";
    public $sortdrection = "DESC";


    public $search;
    public $methode =null;
    public $methode_reglement = 'virement';



    public function updatedPages()
    {
        $this->resetPage('new');
    }

    // for make the button add reglement hidden if contrat aready has reglement
    public function updatedSelectedContrats(){
        $this->isReglementExists=(count(Reglement::whereIn('id_contrat',$this->selectedContrats)->get())>0)? true :false;
        
    }


    //  public $numberOfPaginatorsRendered = [];
    public function render()
    {
        // $this->numberOfPaginatorsRendered[] = 1;
        $this->bulkDisabled = count($this->selectedContrats) < 1;
        $projects = Projet::all();
        $caisses = Caisse::all();
        $avanceArray = Avance::select('id_contrat')->get()->toArray();
        $avanceList = array_column($avanceArray, 'id_contrat');
        $cheques = Cheque::where('situation', 'disponible')->get();
        $contrats = Contrat::where('titre', 'like', '%' . $this->search . '%')
        ->orWhere('datedebut', 'like', '%' . $this->search . '%')
        ->orWhere('datefin', 'like', '%' . $this->search . '%')
        ->orWhereHas('ouvrier', function ($query) {
            $query->where('n_cin', 'like', '%' . $this->search . '%'); })
        ->orderBy($this->sortname, $this->sortdrection)->paginate($this->pages, ['*'], 'new');

        return view('livewire.owner.contrats-list', ["contrats" => $contrats, "projects" => $projects, "caisses" => $caisses, 'cheques' => $cheques, 'avanceList' => $avanceList,]);
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
        $this->titre = $contrat->titre;
        $this->datedebut = $contrat->datedebut;
        $this->datefin = $contrat->datefin;
        $this->montant = $contrat->montant;
        $this->id_projet = $contrat->id_projet;
        $this->type_contrat=($contrat->type_contrat=='particulier')? 'ouvrier': $contrat->type_contrat;
        $this->type_ouvrier = $contrat->type_ouvrier;
        $this->ice_entreprise = $contrat->ice_entreprise;
        $this->name_entreprise = $contrat->name_entreprise;
        $this->ice_fournisseur = ($contrat->type_contrat == 'fournisseur') ? Fournisseur::where('id', $contrat->id_fournisseur)->pluck('ice') : null;
        $this->cin_ouvrier = ($contrat->id_ouvrier != null) ? Ouvrier::where('id', $contrat->id_ouvrier)->pluck('n_cin') : null;
        $this->type_ouvrier = ($contrat->type_contrat == 'particulier') ? 'particulier' : 'entreprise';
       

    }
    public function editData()
    {
        if ($this->type_contrat == "ouvrier") {
            if ($this->type_ouvrier == "particulier") {
                $this->validate([
                    'titre' => 'required',
                    'montant' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                    'type_contrat' => 'required',
                    'type_ouvrier' => 'required',
                    'cin_ouvrier' => 'required|exists:ouvriers,n_cin',
                    'datedebut' => 'required|date|before:datefin',
                    'datefin' => 'required|date|after:datedebut',
                ]);

                $contrat = Contrat::where('id', $this->id_contrat)->first();
                $contrat->titre = $this->titre;
                $contrat->montant = $this->montant;
                $contrat->datedebut = $this->datedebut;
                $contrat->datefin = $this->datefin;
                $contrat->type_contrat = ($this->type_ouvrier == 'particulier') ? 'particulier' : $this->type_contrat;
                $contrat->id_ouvrier = Ouvrier::where('n_cin', $this->cin_ouvrier)->pluck('id')->first();
                $valide = $contrat->save();
            } elseif ($this->type_ouvrier == "entreprise") {

                $this->validate([
                    'titre' => 'required',
                    'montant' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                    'type_contrat' => 'required',
                    'type_ouvrier' => 'required',
                    'name_entreprise' => 'required',
                    'ice_entreprise' => 'required|min:13|max:15',
                    'datedebut' => 'required|date|before:datefin',
                    'datefin' => 'required|date|after:datedebut',
                ]);
                $contrat = Contrat::where('id', $this->id_contrat)->first();
                $contrat->titre = $this->titre;
                $contrat->montant = $this->montant;
                $contrat->datedebut = $this->datedebut;
                $contrat->datefin = $this->datefin;
                $contrat->type_contrat = ($this->type_ouvrier == 'particulier') ? 'particulier' : $this->type_contrat;
                $contrat->name_entreprise = $this->name_entreprise;
                $contrat->ice_entreprise = $this->ice_entreprise;
                $valide = $contrat->save();
            }



        } elseif ($this->type_contrat == "fournisseur") {
            $this->validate([
                'titre' => 'required',
                'montant' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'type_contrat' => 'required',
                'ice_fournisseur' => 'required|exists:fournisseurs,ice',
                'datedebut' => 'required|date|before:datefin',
                'datefin' => 'required|date|after:datedebut',
            ]);
            $contrat = Contrat::where('id', $this->id_contrat)->first();
            $contrat->titre = $this->titre;
            $contrat->montant = $this->montant;
            $contrat->type_contrat = ($this->type_ouvrier == 'particulier') ? 'particulier' : $this->type_contrat;
            $contrat->datedebut = $this->datedebut;
            $contrat->datefin = $this->datefin;
            $contrat->id_fournisseur = Fournisseur::where('ice', $this->ice_fournisseur)->pluck('id')->first();
            $valide = $contrat->save();


        }

        if ($valide) {

            session()->flash('message', 'contrat updated successfully');

        } else {
            session()->flash('error', 'invalide data');
            // $this->dispatchBrowserEvent('close-model');
        }
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-model');
    }

    public function deleteContrat($id)
    {
        $this->id_contrat = $id;
    }

    public function deleteData()
    {
        $avance = Avance::where('id_contrat', $this->id_contrat)->get();
        if (count($avance) > 0) {
            session()->flash('error', 'can\'t delete this contrat cus is used as foring key');

        } else {
            Contrat::findOrFail($this->id_contrat)->delete();
            session()->flash('message', 'contrat deleted successfully');
        }

        $this->dispatchBrowserEvent('close-model');
    }

    public function deleteSelected()
    {
        $avance = Avance::whereIn('id_contrat', $this->selectedContrats)->get();
        if (count($avance) > 0) {
            session()->flash('error', 'can\'t delete selected contrat ');

        } else {
            Contrat::query()
                ->whereIn('id', $this->selectedContrats)
                ->delete();
            $this->selectedContrats = [];
            $this->selectAll = false;
            session()->flash('message', 'all selected contrat are deleted successfully');


        }


    }

    public function saveContrat()
    {
        if ($this->type_contrat == "ouvrier") {
            if ($this->type_ouvrier == "particulier") {
                $this->validate([
                    'titre' => 'required',
                    'montant' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                    'type_contrat' => 'required',
                    'type_ouvrier' => 'required',
                    'cin_ouvrier' => 'required|exists:ouvriers,n_cin',
                    'datedebut' => 'required|date|before:datefin',
                    'datefin' => 'required|date|after:datedebut',
                ]);

                $contrat = new Contrat();
                $contrat->titre = $this->titre;
                $contrat->montant = $this->montant;
                $contrat->datedebut = $this->datedebut;
                $contrat->datefin = $this->datefin;
                $contrat->type_contrat = ($this->type_ouvrier == 'particulier') ? 'particulier' : $this->type_contrat;
                $contrat->id_ouvrier = Ouvrier::where('n_cin', $this->cin_ouvrier)->pluck('id')->first();
                $valide = $contrat->save();
            } elseif ($this->type_ouvrier == "entreprise") {

                $this->validate([
                    'titre' => 'required',
                    'montant' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                    'type_contrat' => 'required',
                    'type_ouvrier' => 'required',
                    'name_entreprise' => 'required',
                    'ice_entreprise' => 'required|min:13|max:15',
                    'datedebut' => 'required|date|before:datefin',
                    'datefin' => 'required|date|after:datedebut',
                ]);
                $contrat = new Contrat();
                $contrat->titre = $this->titre;
                $contrat->montant = $this->montant;
                $contrat->datedebut = $this->datedebut;
                $contrat->datefin = $this->datefin;
                $contrat->type_contrat = ($this->type_ouvrier == 'particulier') ? 'particulier' : $this->type_contrat;
                $contrat->name_entreprise = $this->name_entreprise;
                $contrat->ice_entreprise = $this->ice_entreprise;
                $valide = $contrat->save();
            }



        } elseif ($this->type_contrat == "fournisseur") {
            $this->validate([
                'titre' => 'required',
                'montant' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'type_contrat' => 'required',
                'ice_fournisseur' => 'required|exists:fournisseurs,ice',
                'datedebut' => 'required|date|before:datefin',
                'datefin' => 'required|date|after:datedebut',
            ]);
            $contrat = new Contrat();
            $contrat->titre = $this->titre;
            $contrat->montant = $this->montant;
            $contrat->type_contrat = ($this->type_ouvrier == 'particulier') ? 'particulier' : $this->type_contrat;
            $contrat->datedebut = $this->datedebut;
            $contrat->datefin = $this->datefin;
            $contrat->id_fournisseur = Fournisseur::where('ice', $this->ice_fournisseur)->pluck('id')->first();
            $valide = $contrat->save();


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

   
    // add avance 
    public  function addAvance($id)
    {
        $this->id_contrat = $id;
        $this->date_avance = date('Y-m-d');
    }
    public function saveAvance()
    {

        $this->validate([
            'montant' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'methode' => 'required',
            'date_avance' => 'required|date',
            'numero_cheque' => 'required_if:methode,cheque|exists:cheques,numero,situation,disponible|nullable',
            'id_caisse' => 'required_if:methode,cach|nullable',
            'ref_virement' => 'required_if:methode,virement|nullable',
            'ref_med' => 'required_if:methode,med|nullable',
        ]);

        $avance = new Avance();
        $avance->montant = $this->montant;
        $avance->methode = $this->methode;
        $avance->date = $this->date_avance;
        $avance->id_contrat = $this->id_contrat;
        if ($this->methode == "cheque") {
            $avance->numero_cheque = $this->numero_cheque;
            $valide = Cheque::where('numero', $this->numero_cheque)->update(['situation' => 'livrer', 'type' => 'avance contrat', 'montant' => $this->montant]);
        } elseif ($this->methode == 'cach') {
            $retrait = new Retrait();
            $retrait->dateRet = $this->date_avance;
            $retrait->montant = $this->montant;
            $retrait->id_caisse = $this->id_caisse;
            $retrait->type_of_sold = 'sold_nonJustify';

            $valide = $retrait->save();
            if ($valide) {
                $caisse = Caisse::where('id', $this->id_caisse)->first();
                $caisse->sold_nonJustify -= $this->montant;
                $valide = $caisse->update();
                if ($valide) {
                    $avance->id_retrait = $retrait->id;
                }

            }


        } elseif ($this->methode == 'med') {
            $avance->ref_med = $this->ref_med;
        } elseif ($this->methode == 'virement') {
            $avance->ref_virement = $this->ref_virement;
        }
        $valide = $avance->save();
        if ($valide) {
            $montant_avance = Avance::where('id_contrat', $this->id_contrat)->sum('montant');
            $contart = Contrat::where('id', $this->id_contrat)->first();
            $contart->avance = $montant_avance;
            $contart->update();
            session()->flash('message', 'avence add succesfully ');

        } else {
            session()->flash('error', 'invalide data ');
        }
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-model');
    }



    // add reglement to contrat
    public function addReglement(){
        $contart=Contrat::whereIn('id',$this->selectedContrats)->first();
        $this->montant=$contart->montant_reste;
        $this->date=date('Y-m-d');
        $this->methode='virement';
        $this->id_contrat=$contart->id;
        
    }
    public function saveReglement()
    {


        if ($this->methode_reglement == "cheque") {
            $this->validate([
                'date' => 'required|date',
                'montant' => 'required|regex:/^\d*(\.\d{2})?$/',
                'montant_cheque' => 'required|regex:/^\d*(\.\d{2})?$/',
                'numero_cheque' => 'required|exists:cheques,numero,situation,disponible',
                'cheque_pdf' => 'required|mimes:pdf',
            ]);
            $cheque = Cheque::where('numero', $this->numero_cheque)->first();
            $cheque->montant = $this->montant_cheque;
            $cheque->situation = "livrer";
            $cheque->type = "contrat";
            $cheque->update();

            $this->cheque_pdf = $this->cheque_pdf->store('Documents/Reglement/cheques', 'public');
            $reglement = new Reglement();
            $reglement->dateR = $this->date;
            $reglement->montant = $this->montant;
            $reglement->methode = $this->methode_reglement;
            $reglement->numero_cheque = $this->numero_cheque;
            $reglement->ref_med = $this->ref_med;
            $reglement->cheque_pdf = $this->cheque_pdf;
            $reglement->id_contrat=$this->id_contrat;
            $valide = $reglement->save();


        } elseif ($this->methode_reglement == "cach") {
            $this->validate([
                'date' => 'required|date',
                'montant' => 'required|regex:/^\d*(\.\d{2})?$/',
                'id_caisse' => 'required',
            ]);


            $reglement = new Reglement();
            $reglement->dateR = $this->date;
            $reglement->montant = $this->montant;
            $reglement->methode = $this->methode_reglement;
            $reglement->id_contrat=$this->id_contrat;
            $valide = $reglement->save();
            $retrait = new Retrait();
            $retrait->montant = $this->montant;
            $retrait->dateRet = date('Y-m-d');
            $retrait->id_caisse = $this->id_caisse;
            $retrait->id_reglement = $reglement->id;
            $retrait->type_of_sold = 'sold_nonJustify';
            $valide = $retrait->save();
            $caisse = Caisse::where('id', $this->id_caisse)->first();
            $caisse->sold_nonjustify -= $this->montant;
            $valide = $caisse->update();

        } elseif ($this->methode_reglement == "virement") {
            $this->validate([
                'date' => 'required|date',
                'montant' => 'required|regex:/^\d*(\.\d{2})?$/',
                'ref_virement' => 'required',
            ]);
            $reglement = new Reglement();
            $reglement->dateR = $this->date;
            $reglement->montant = $this->montant;
            $reglement->methode = $this->methode_reglement;
            $reglement->ref_virement = $this->ref_virement;
            $reglement->id_contrat=$this->id_contrat;
            $valide = $reglement->save();

        } elseif ($this->methode_reglement = "med") {
            $this->validate([
                'date' => 'required|date',
                'montant' => 'required|regex:/^\d*(\.\d{2})?$/',
                'ref_med' => 'required',
            ]);
            $reglement = new Reglement();
            $reglement->dateR = $this->date;
            $reglement->montant = $this->montant;
            $reglement->methode = $this->methode_reglement;
            $reglement->ref_med = $this->ref_med;
            $reglement->id_contrat=$this->id_contrat;
            $valide = $reglement->save();
        }
        if ($valide) {
            
            session()->flash('message', 'reglement bien ajouter');
        } else {
            session()->flash('error', 'invalide data');

        }
        $this->selectedCharges = [];
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-model');

    }

}