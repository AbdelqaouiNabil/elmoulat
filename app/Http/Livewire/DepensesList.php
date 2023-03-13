<?php

namespace App\Http\Livewire;

use App\Models\Cheque;
use App\Models\Depense;
use App\Models\Facture;
use App\Models\Projet;
use App\Models\Ouvrier;
use App\Models\Retrait;
use App\Models\Caisse;
use Illuminate\Routing\Middleware\ThrottleRequestsWithRedis;
use Livewire\Component;

use Livewire\WithPagination;
use Livewire\WithFileUploads;

class DepensesList extends Component
{
    use WithFileUpLoads;
    use WithPagination;


    public $depenseInfos;
    public $id_depense, $id_project, $id_ouvrier, $id_caisse, $dateDep, $description, $Aqui, $type, $montant, $Aouvrier,
    $nonJustifier, $justifier, $cin_ouvrier, $autre_type, $type_depense,
    $numero_cheque, $ref_virement, $ref_med, $description_data, $checkIfnotJustify, $numero_facture, $montant_facture, $montantTotal, $check_cheque;
    public $pages = 10;
    public $type_caisse = "sold_nonJustify";
    public $methode = "cach";
    public $bulkDisabled = true;
    public $selectedDepenses = [];
    public $selectAll = false;

    public $search = "";
    protected $queryString = ['search'];
    public $montantBeforeUpdate;
    public $typeDepense = ["Autre", "Ouvrier", "Personnel et charges sociales", "Equipements et matériel", "Entretien et aménagement", "bureautique et documentations", "Produit sanitaires et nettoyage", "Eau et électricité", "Service communication", "Transport et Véhicules", "Déplacements", "missions et réceptions", "Location", "Honoraires & Services", "Assurances", "Frais et Agios bancaire", "Impôts, taxes, Pénalités et amendes", "Prelevement Echance XXXX", "Dons", "Divers", "Lot Terrain", "Lot Construction", "Lot Eau et Plomberie", "Lot Menuiserie", "Lot Ferronnerie", "Lot Electricité", "Lot Platerie", "Lot Carreaux et marbre", "Lot Peinture", "Lot Climatisation", "Lot Administration", "Lot architecture, Ingénierie et études", "Lot gardiennage et divers", "Lot Ascenseur", "Lot signalisation et publicité"];

    public $filter;

    public function updatedPages()
    {
        $this->resetPage('new');
    }


    public function render()
    {

        $this->montantTotal = (count($this->selectedDepenses) == 0) ? Depense::where('situation', 'Non Justify')->sum('montant') : $this->montantTotal = Depense::whereIn('id', $this->selectedDepenses)->sum('montant');
        $this->bulkDisabled = count($this->selectedDepenses) < 1;
        $projets = Projet::all();
        $caisses = Caisse::all();
        $depenses = Depense::orderBy('id', 'DESC')->paginate($this->pages, ['*'], 'new');

        // FOR THE FILTERING JUSTIFY OR NON JUSTIFY
        switch ($this->filter) {
            case null:
                $depenses = Depense::orderBy('id', 'DESC')->paginate($this->pages, ['*'], 'new');
                break;
            case 'Justifier':
                $depenses = Depense::where('situation', 'Justify')->paginate($this->pages, ['*'], 'new');
                break;
            case 'Non Justifier':
                $depenses = Depense::where('situation', 'Non Justify')->paginate($this->pages, ['*'], 'new');
                break;
            default:
                $depenses = Depense::orderBy('id', 'DESC')->paginate($this->pages, ['*'], 'new');
                break;
        }

        if ($this->search != "") {
            $depenses = Depense::where('stiuation', 'like', '%' . $this->search . '%')->paginate($this->pages, ['*'], 'new');
        }

        return view('livewire.owner.depenses-list', ['depenses' => $depenses, 'projets' => $projets, 'caisses' => $caisses, 'montantTotal' => $this->montantTotal]);
    }






    public function editDepense($id)
    {
        $depense = Depense::where('id', $id)->first();
        $this->id_depense = $id;
        $this->montant = $depense->montant;
        $this->dateDep = $depense->dateDep;
        $this->description = $depense->description;
        $this->type_depense = (in_array($depense->type_depense, $this->typeDepense) == false) ? 'Autre' : $depense->type_depense;
        $this->autre_type = ($this->type_depense == 'Autre') ? $depense->type_depense : null;
        $this->autre_type = $depense->type_depense;
        $this->methode = $depense->methode;
        $this->cin_ouvrier = ($this->type_depense == "Ouvrier") ? Ouvrier::where('id', $depense->id_ouvrier)->pluck('n_cin')->first() : null;
        $this->numero_cheque = $depense->numero_cheque;
        $this->id_project = $depense->id_project;
        $this->id_caisse = ($this->methode == "cach") ? Retrait::where('id_depense', $id)->pluck('id_caisse')->first() : null;
        $this->type_caisse = ($this->methode == "cach") ? Retrait::where('id_depense', $id)->pluck('type_of_sold')->first() : null;


    }

    // update depense


    public function modifierDepense()
    {


        $depense = Depense::where('id', $this->id_depense)->first();
        if ($this->methode != $depense->methode) {

            // clear data from old data
            if ($depense->methode == "cach") {
                $retrait = Retrait::where('id_depense', $depense->id)->first();
                $caisse = Caisse::where('id', $retrait->id_caisse)->first();
                ($retrait->type_of_sold == "Non Justify") ? $caisse->update(['sold_nonJustify' => ($caisse->sold_nonJustify += $retrait->montant)]) : $caisse->update(['sold_nonJustify' => ($caisse->sold += $retrait->montant)]);
                $valide = $retrait->delete();
            } elseif ($depense->methode == "cheque") {
                $valide = Cheque::where('numero', $depense->numero_cheque)->update(['situation' => 'disponible', 'type' => null]);
            }
        }

        if ($this->methode == "cheque") {
            $this->validate([
                'montant' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'numero_cheque' => 'required|exists:cheques,numero,situation,disponible',
                'dateDep' => 'required|date',
                'type_depense' => 'required',
                'autre_type' => 'required_if:type_depense,Autre',
                'cin_ouvrier' => 'required_if:type_depense,Ouvrier|exists:ouvriers,n_cin|nullable',
                'id_project' => 'required',
                'methode' => 'required',
            ]);

            $depense->montant = $this->montant;
            $depense->dateDep = $this->dateDep;
            $depense->description = $this->description;
            $depense->id_project = $this->id_project;
            $depense->numero_cheque = $this->numero_cheque;
            $depense->situation = 'Non Justify';
            $depense->methode = $this->methode;
            $depense->ref_med = null;
            $depense->ref_virement = null;
            $depense->type_depense = ($this->type_depense == "Autre") ? $this->autre_type : $this->type_depense;
            $depense->id_ouvrier = ($this->type_depense == "Ouvrier") ? Ouvrier::where('n_cin', $this->cin_ouvrier)->pluck('id')->first() : null;
            $valide = $depense->update();
            if ($valide) {
                $cheque = Cheque::where('numero', $this->numero_cheque)->first();
                $cheque->situation = 'livrer';
                $cheque->type = 'depense';
                $valide = $cheque->update();
            }
        } elseif ($this->methode == "cach") {
            $this->validate([
                'montant' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'dateDep' => 'required|date',
                'type_depense' => 'required',
                'autre_type' => 'required_if:type_depense,Autre',
                'cin_ouvrier' => 'required_if:type_depense,Ouvrier|exists:ouvriers,n_cin|nullable',
                'id_project' => 'required',
                'methode' => 'required',
                'id_caisse' => 'required',
                'type_caisse' => 'required',
            ]);


            $depense->montant = $this->montant;
            $depense->dateDep = $this->dateDep;
            $depense->description = $this->description;
            $depense->id_project = $this->id_project;
            $depense->situation = ($this->type_caisse == "sold_nonJustify") ? 'Non Justify' : 'justify';
            $depense->methode = $this->methode;
            $depense->type_depense = ($this->type_depense == "Autre") ? $this->autre_type : $this->type_depense;
            $depense->id_ouvrier = ($this->type_depense == "Ouvrier") ? Ouvrier::where('n_cin', $this->cin_ouvrier)->pluck('id')->first() : null;
            $valide = $depense->update();


            if ($valide) {
                $retrait = Retrait::where('id_depense', $this->id_depense)->first();
                if ($retrait) {
                    $caisse = Caisse::where('id', $retrait->id_caisse)->first();
                    ($retrait->type_of_sold == "Non Justify") ? $caisse->update(['sold_nonJustify' => ($caisse->sold_nonJustify += $retrait->montant)]) : $caisse->update(['sold' => ($caisse->sold += $retrait->montant)]);
                    $valide = $retrait->delete();
                }

                $retrait = new Retrait();
                $retrait->dateRet = date('Y-m-d');
                $retrait->montant = $this->montant;
                $retrait->id_caisse = $this->id_caisse;
                $retrait->id_depense = $depense->id;
                $retrait->type_of_sold = $this->type_caisse;
                $valide = $retrait->save();
                if ($valide) {
                    $caisse = Caisse::where('id', $this->id_caisse)->first();
                    if ($this->type_caisse == "sold_nonJustify") {
                        $caisse->sold_nonJustify -= $this->montant;
                    } else {
                        $caisse->sold -= $this->montant;
                    }
                    $valide = $caisse->update();
                }
            }


        } elseif ($this->methode == "virement") {

            $this->validate([
                'montant' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'ref_virement' => 'required',
                'dateDep' => 'required|date',
                'type_depense' => 'required',
                'autre_type' => 'required_if:type_depense,Autre',
                'cin_ouvrier' => 'required_if:type_depense,Ouvrier|exists:ouvriers,n_cin|nullable',
                'id_project' => 'required',
                'methode' => 'required',
            ]);

            $depense->montant = $this->montant;
            $depense->dateDep = $this->dateDep;
            $depense->description = $this->description;
            $depense->id_project = $this->id_project;
            $depense->ref_virement = $this->ref_virement;
            $depense->ref_med = null;
            $depense->numero_cheque = null;
            $depense->situation = 'Non Justify';
            $depense->methode = $this->methode;
            $depense->type_depense = ($this->type_depense == "Autre") ? $this->autre_type : $this->type_depense;
            $depense->id_ouvrier = ($this->type_depense == "Ouvrier") ? Ouvrier::where('n_cin', $this->cin_ouvrier)->pluck('id')->first() : null;
            $valide = $depense->update();


        } elseif ($this->methode == "med") {
            $this->validate([
                'montant' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'ref_med' => 'required',
                'dateDep' => 'required|date',
                'type_depense' => 'required',
                'autre_type' => 'required_if:type_depense,Autre',
                'cin_ouvrier' => 'required_if:type_depense,Ouvrier|exists:ouvriers,n_cin|nullable',
                'id_project' => 'required',
                'methode' => 'required',
            ]);


            $depense->montant = $this->montant;
            $depense->dateDep = $this->dateDep;
            $depense->description = $this->description;
            $depense->id_project = $this->id_project;
            $depense->ref_med = $this->ref_med;
            $depense->ref_virement = null;
            $depense->numero_cheque = null;
            $depense->situation = 'Non Justify';
            $depense->methode = $this->methode;
            $depense->type_depense = ($this->type_depense == "Autre") ? $this->autre_type : $this->type_depense;
            $depense->id_ouvrier = ($this->type_depense == "Ouvrier") ? Ouvrier::where('n_cin', $this->cin_ouvrier)->pluck('id')->first() : null;
            $valide = $depense->update();
        }
        if ($valide) {
            session()->flash('message', 'Depense update successfully');
            $this->dispatchBrowserEvent('add');

        } else {
            session()->flash('error', 'invalide data');
        }
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-model');



    }
    // for check is there any disponible check to use inside ajouter button
    public function checkCheque(){
        $this->check_cheque=Cheque::where('situation','disponible')->get();
    }
    // save depense 
    public function saveDepense()
    {
        if ($this->methode == "cheque") {
            $this->validate([
                'montant' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'numero_cheque' => 'required|exists:cheques,numero,situation,disponible',
                'dateDep' => 'required|date',
                'type_depense' => 'required',
                'autre_type' => 'required_if:type_depense,Autre',
                'cin_ouvrier' => 'required_if:type_depense,Ouvrier|exists:ouvriers,n_cin|nullable',
                'id_project' => 'required',
                'methode' => 'required',
            ]);



            $depense = new Depense();
            $depense->montant = $this->montant;
            $depense->dateDep = $this->dateDep;
            $depense->description = $this->description;
            $depense->id_project = $this->id_project;
            $depense->numero_cheque = $this->numero_cheque;
            $depense->situation = 'Non Justify';
            $depense->methode = $this->methode;
            $depense->type_depense = ($this->type_depense == "Autre") ? $this->autre_type : $this->type_depense;
            $depense->id_ouvrier = ($this->type_depense == "Ouvrier") ? Ouvrier::where('n_cin', $this->cin_ouvrier)->pluck('id')->first() : null;
            $valide = $depense->save();
            if ($valide) {
                $cheque = Cheque::where('numero', $this->numero_cheque)->first();
                $cheque->situation = 'livrer';
                $cheque->type = 'depense';
                $valide = $cheque->update();
            }
        } elseif ($this->methode == "cach") {
            $this->validate([
                'montant' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'dateDep' => 'required|date',
                'type_depense' => 'required',
                'autre_type' => 'required_if:type_depense,Autre',
                'cin_ouvrier' => 'required_if:type_depense,Ouvrier|exists:ouvriers,n_cin|nullable',
                'id_project' => 'required',
                'methode' => 'required',
                'id_caisse' => 'required',
                'type_caisse' => 'required',
            ]);

            $depense = new Depense();
            $depense->montant = $this->montant;
            $depense->dateDep = $this->dateDep;
            $depense->description = $this->description;
            $depense->id_project = $this->id_project;
            $depense->situation = ($this->type_caisse == "sold_nonJustify") ? 'Non Justify' : 'justify';
            $depense->methode = $this->methode;
            $depense->type_depense = ($this->type_depense == "Autre") ? $this->autre_type : $this->type_depense;
            $depense->id_ouvrier = ($this->type_depense == "Ouvrier") ? Ouvrier::where('n_cin', $this->cin_ouvrier)->pluck('id')->first() : null;
            $valide = $depense->save();
            if ($valide) {
                $retrait = new Retrait();
                $retrait->dateRet = date('Y-m-d');
                $retrait->montant = $this->montant;
                $retrait->id_caisse = $this->id_caisse;
                $retrait->id_depense = $depense->id;
                $retrait->type_of_sold = $this->type_caisse;
                $valide = $retrait->save();
                if ($valide) {
                    $caisse = Caisse::where('id', $this->id_caisse)->first();
                    if ($this->type_caisse == "sold_nonJustify") {
                        $caisse->sold_nonJustify -= $this->montant;
                    } else {
                        $caisse->sold -= $this->montant;
                    }
                    $valide = $caisse->update();
                }
            }


        } elseif ($this->methode == "virement") {

            $this->validate([
                'montant' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'ref_virement' => 'required',
                'dateDep' => 'required|date',
                'type_depense' => 'required',
                'autre_type' => 'required_if:type_depense,Autre',
                'cin_ouvrier' => 'required_if:type_depense,Ouvrier|exists:ouvriers,n_cin|nullable',
                'id_project' => 'required',
                'methode' => 'required',
            ]);



            $depense = new Depense();
            $depense->montant = $this->montant;
            $depense->dateDep = $this->dateDep;
            $depense->description = $this->description;
            $depense->id_project = $this->id_project;
            $depense->ref_virement = $this->ref_virement;
            $depense->situation = 'Non Justify';
            $depense->methode = $this->methode;
            $depense->type_depense = ($this->type_depense == "Autre") ? $this->autre_type : $this->type_depense;
            $depense->id_ouvrier = ($this->type_depense == "Ouvrier") ? Ouvrier::where('n_cin', $this->cin_ouvrier)->pluck('id')->first() : null;
            $valide = $depense->save();


        } elseif ($this->methode == "med") {
            $this->validate([
                'montant' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'ref_med' => 'required',
                'dateDep' => 'required|date',
                'type_depense' => 'required',
                'autre_type' => 'required_if:type_depense,Autre',
                'cin_ouvrier' => 'required_if:type_depense,Ouvrier|exists:ouvriers,n_cin|nullable',
                'id_project' => 'required',
                'methode' => 'required',
            ]);



            $depense = new Depense();
            $depense->montant = $this->montant;
            $depense->dateDep = $this->dateDep;
            $depense->description = $this->description;
            $depense->id_project = $this->id_project;
            $depense->ref_med = $this->ref_med;
            $depense->situation = 'Non Justify';
            $depense->methode = $this->methode;
            $depense->type_depense = ($this->type_depense == "Autre") ? $this->autre_type : $this->type_depense;
            $depense->id_ouvrier = ($this->type_depense == "Ouvrier") ? Ouvrier::where('n_cin', $this->cin_ouvrier)->pluck('id')->first() : null;
            $valide = $depense->save();
        }


        if ($valide) {
            session()->flash('message', 'Depense created successfully');
            $this->dispatchBrowserEvent('add');

        } else {
            session()->flash('error', 'invalide data');
        }
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-model');
    }





    public function resetInputs()
    {
        $this->montant = "";
        $this->Aqui = "";
        $this->justifier = false;
        $this->nonJustifier = false;
        $this->dateDep = "";
        $this->Aqui = "";
        $this->description = "";
        $this->Aouvrier = false;
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedDepenses = Depense::pluck('id');
            $this->checkIfnotJustify = false;
        } else {
            $this->selectedDepenses = [];
        }
    }

    // for show discription inside modal 
    public function Description($id)
    {
        $this->description_data = Depense::where('id', $id)->pluck('description')->first();
    }
    // 
    public function updatedSelectedDepenses()
    {
        $depense = Depense::whereIn('id', $this->selectedDepenses)->where('situation', 'Justify')->get();

        $this->checkIfnotJustify = (count($depense) > 0) ? false : true;
        if ($this->checkIfnotJustify == false) {
            session()->flash('error', 'Error: you selected Justify Depense');
        }
        $this->montantTotal = Depense::whereIn('id', $this->selectedDepenses)->sum('montant');

    }

    // add facture to depense for justify them
    public function addFacture()
    {

        $this->validate([
            'numero_facture' => 'required|exists:factures,numero,type,fake',
            'montant_facture' => 'required|exists:factures,montant,numero,' . $this->numero_facture . '|different:' . $this->montantTotal . '',
        ]);
        $facture = Facture::where('numero', $this->numero_facture)->pluck('id')->first();

        if (count($this->selectedDepenses) > 0) {
            $depense = Depense::whereIn('id', $this->selectedDepenses)->update(['id_facture' => $facture, 'situation' => 'justify']);
        } else {
            $depense = Depense::where('situation', 'Non Justify')->update(['id_facture' => $facture, 'situation' => 'justify']);
        }

        if ($depense) {
            session()->flash('message', 'facture add succesfuly');
        } else {
            session()->flash('error', 'invalide data');
        }
        // $this->dispatchBrowserEvent('close-model');

    }


    // delete data 

    public function deleteItem($id)
    {
        $this->id_depense = $id;
    }
    public function deleteData()
    {
        $retrait = Retrait::where('id_depense', $this->id_depense)->first();
        if ($retrait) {
            session()->flash('error', 'can\'t delete this item cus is used as foring key in retrait ');
        } else {
            $depense = Depense::where('id', $this->id_depense)->first();
            ($depense->methode == 'cheque') ? Cheque::where('numero', $depense->numero_cheque)->update(['situation' => 'disponible', 'type' => null]) : false;
            $valide = $depense->delete();
            if ($valide) {
                session()->flash('message', 'delete item succesfully');
            } else {
                session()->flash('error', 'errror');

            }

        }
        $this->dispatchBrowserEvent('close-model');
        $this->resetInputs();

    }


}