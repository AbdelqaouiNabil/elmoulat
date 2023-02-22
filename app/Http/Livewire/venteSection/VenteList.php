<?php

namespace App\Http\Livewire\VenteSection;

use App\Models\Avence;
use App\Models\Client;
use App\Models\Depense;
use App\Models\Projet;
use App\Models\Vente;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Imports\Importvente;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use File;


class VenteList extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $titre, $montant, $montantReal, $contrat, $avence, $id_project, $id_client, $id_vente, $name, $cin, $n_cin, $email, $ville_de_resi, $phone, $excelFile;
    public $checked_id = [];
    public $selectAll = false;
    public $btndelete = true;
    public $sortname = "id";
    public $sortdrection = "DESC";
    public $pages = 5;
    public $search;
    protected $listeners = ['saveData' => 'saveData'];



    public function render()
    {
        $this->btndelete = count($this->checked_id) < 1;
        $projects = Projet::all();
        $ventes = vente::where('titre', 'like', '%' . $this->search . '%')
            ->orWhere('project_id', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortname, $this->sortdrection)->paginate($this->pages, ['*'], 'new');
        return view('livewire.vente-section.vente-list', ['ventes' => $ventes, 'projects' => $projects]);
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

    // for paginate
    public function updatingPages($value)
    {
        $this->resetPage('new');

    }

    public function saveData()
    {

        
        $this->validate([
            'titre' => 'required',
            'id_project' => 'required|integer',
            'montant' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'montantReal' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'avence' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'contrat' => 'required|mimes:pdf',
            'name' => 'required',
            'cin' => 'required|mimes:pdf',
            'n_cin' => 'required|unique:clients',
            'phone' => 'required|regex:/[0-9]*/',
        ]);
        

        
        
        $client = new Client();
        $client->name = $this->name;
        $client->cin = $this->cin->store('Documents/client', 'public');
        $client->n_cin = $this->n_cin;
        $client->phone = $this->phone;
        $client->email = $this->email;
        $client->ville_de_resi = $this->ville_de_resi;
        $valide = $client->save();

        if ($valide) {
            $contrat = $this->contrat->store('Documents/vente', 'public');
            $vente = new Vente();
            $vente->titre = $this->titre;
            $vente->contrat = $contrat;
            $vente->montant = $this->montant;
            $vente->montantReal = $this->montantReal;
            $vente->paye = $this->avence;
            $vente->project_id = $this->id_project;
            $vente->client_id = $client->id;
            $valide = $vente->save();
            if($valide){
                $avence=new Avence();
                $avence->dateA =date('Y-m-d');
                $avence->id_client=$client->id;
                $avence->id_vente=$vente->id;
                $avence->montant=$this->montant;
                $valide=$avence->save();
                
            }
        }

        if($valide){
         session()->flash('message', 'vente bien ajouter');
        $this->dispatchBrowserEvent('add');
        $this->resetInputs();
        }else{
         session()->flash('error', 'you enterd rong type of data');

        }

        // for hidden the model
        $this->dispatchBrowserEvent('close-model');



    }

    private function resetInputs()
    {

        $this->name = "";
        $this->cin = "";
        $this->n_cin = "";
        $this->email = "";
        $this->phone = "";
        $this->ville_de_resi = "";
        $this->id_client = "";
        $this->id_vente = "";
        $this->id_project = "";
        $this->montant = "";
        $this->montantReal = "";
        $this->avence = "";
        $this->contrat = "";


    }

    // validator function
    //   validation real -time
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'titre' => 'required',
            'id_project' => 'required|integer',
            'montant' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'montantReal' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'avence' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'contrat' => 'required|mimes:pdf',
            'name' => 'required',
            'cin' => 'required|mimes:pdf',
            'n_cin' => 'required|unique:clients',
            'phone' => 'required|regex:/[0-9]*/',
        ]);
    }



    // delete vente

    public function deletevente($id)
    {

        $this->id_vente = $id;
    }

    public function deleteData()
    {

        $avence = Avence::where('id_vente', $this->id_vente)->get();

        if (count($avence) > 1) {
            session()->flash('error', 'This vente is Used as ForienKey in anthor Table');

        } else {
            $vente = vente::where('id', $this->id_vente)->first();
            $path = Storage::disk('local')->url($vente->cin);
            File::delete(public_path($path));
            $vente->delete();
            session()->flash('message', 'vente bien supprimer ');
            $this->dispatchBrowserEvent('add');
        }

        $this->dispatchBrowserEvent('close-model');
    }



    //edit vente=====================

    public function editvente($id)
    {
        $vente = vente::where('id', $id)->first();
        $this->id_vente = $id;
        $this->titre = $vente->titre;
        $this->contrat = $vente->contrat;
        $this->montant = $vente->montant;
        $this->montantReal = $vente->montantReal;
        $this->avence = $vente->paye;
        $this->id_project = $vente->id_project;
        $this->id_client = $vente->id_client;

    }

    public function editData()
    {
        
        $this->validate([
            'titre' => 'required',
            'id_project' => 'required|integer',
            'montant' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'montantReal' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'avence' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'name' => 'required',
            'n_cin' => 'required|unique:clients',
            'phone' => 'required|regex:/[0-9]*/',

        ]);

        $vente = vente::where('id', $this->id_vente)->first();
        $vente->titre = $this->titre;
        $vente->montant = $this->montant;
        $vente->montantReal = $this->montantReal;
        $vente->email = $this->email;
        $vente->ville_de_resi = $this->ville_de_resi;
        $vente->update();
        $this->resetInputs();
        session()->flash('message', 'vente bien modifer');
        $this->dispatchBrowserEvent('close-model');
    }


    // delete check all boxs

    public function deletecheckedvente()
    {


        $vente = Vente::whereIn('vente_id', $this->checked_id)->get();

        if (count($vente) > 0) {
            session()->flash('error', 'This vente is Used as ForienKey in anthor Table');
        } else {
            $ventes = vente::whereIn('id', $this->checked_id)->get();
            foreach ($ventes as $vente) {
                $path = Storage::disk('local')->url($vente->cin);
                File::delete(public_path($path));
                $vente->delete();
            }
            $this->checked_id = [];
            $this->selectAll = false;
            session()->flash('message', 'projet bien supprimer');
            $this->resetInputs();
        }
        $this->dispatchBrowserEvent('close-model');

    }
    public function updatedselectAll($value)
    {
        if ($value) {
            $this->checked_id = vente::pluck('id');

        } else {
            $this->checked_id = [];
            $this->btndelete = true;
        }
    }
    // end of check all boxs



    //  import vente 

    public function importData()
    {
        $this->validate([

            'excelFile' => 'required|mimes:xlsx,xls',
        ]);
        // $path= $this->exelFile->store('documents/venteExcel','app');
        // $path = file_get_contents($path);
        session()->flash('message', 'ventes bien importer');

    }
//  import project end


}