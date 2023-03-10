<?php

namespace App\Http\Livewire\VenteSection;

use App\Models\Avence;
use App\Models\Bien;
use App\Models\Client;
use App\Models\Depense;
use App\Models\Projet;
use App\Models\Vente;
use Illuminate\Auth\Events\Validated;
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

    public $titre, $dateV, $montant, $montantReal, $contrat, $avence, $id_bien, $id_client, $id_vente, $name, $cin, $n_cin, $email, $ville_de_resi, $phone, $type, $clientname, $totalavence, $excelFile;
    public $checked_id = [];
    public $avences = [];

    public $selectAll = false;
    public $btndelete = true;
    public $sortname = "ventes.id";
    public $sortdrection = "DESC";
    public $pages = 5;
    public $search;
    public $cb_client = false;
    protected $listeners = ['saveData' => 'saveData'];




    public function render()
    {
        // 
        $this->btndelete = count($this->checked_id) < 1;
        $biens = Bien::all();
        $clients = Client::all();
        $ventes = vente::where('titre', 'like', '%' . $this->search . '%')
            ->orWhereHas('client' , function($query){$query->where('n_cin', 'like', '%' . $this->search . '%');})
            ->orWhereHas('bien' , function($query){$query->where('situation', 'like', '%' . $this->search . '%');})
            ->orderBy($this->sortname, $this->sortdrection)->paginate($this->pages, ['*'], 'new');
        return view('livewire.vente-section.vente-list', ['ventes' => $ventes, 'biens' => $biens, 'clients' => $clients]);
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


        if ($this->cb_client == true) {
            $this->validate([
                'titre' => 'required',
                'dateV' => 'required|date',
                'id_bien' => 'required|integer',
                'montant' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'montantReal' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'contrat' => 'required|mimes:pdf',
                'n_cin' => 'required',
            ]);
            $client = Client::where('n_cin', $this->n_cin)->first();
            if (is_null($client)) {
                session()->flash('myerror', 'Numero cin doesn\'t exist');
                return;
            } else {
                $valide = true;
            }


        } else {
            $this->validate([
                'titre' => 'required',
                'dateV' => 'required|date',
                'id_bien' => 'required|integer',
                'montant' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'montantReal' => 'required|regex:/^\d+(\.\d{1,2})?$/',
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
        }

        if ($valide) {
            $contrat = $this->contrat->store('Documents/vente', 'public');
            $vente = new Vente();
            $vente->titre = $this->titre;
            $vente->dateV = $this->dateV;
            $vente->contrat = $contrat;
            $vente->montant = $this->montant;
            $vente->montantReal = $this->montantReal;
            $vente->project_id = $this->id_bien;
            $vente->id_client = $client->id;
            $valide = $vente->save();

        }

        if ($valide) {
            session()->flash('message', 'vente bien ajouter');
            $this->dispatchBrowserEvent('add');
            $this->resetInputs();
        } else {
            session()->flash('error', 'you enterd rong type of data');

        }

        // for hidden the model
        $this->dispatchBrowserEvent('close-model');



    }

    private function resetInputs()
    {

        $this->name = "";
        $this->titre = "";
        $this->dateV = "";
        $this->cin = "";
        $this->n_cin = "";
        $this->email = "";
        $this->phone = "";
        $this->ville_de_resi = "";
        $this->id_client = "";
        $this->id_vente = "";
        $this->id_bien = "";
        $this->montant = "";
        $this->montantReal = "";
        $this->avence = "";
        $this->contrat = "";
        $this->type = "";


    }

    // validator function
    //   validation real -time
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'titre' => 'required',
            'dateV' => 'required|date',
            'id_bien' => 'required|integer',
            'montant' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'montantReal' => 'required|regex:/^\d+(\.\d{1,2})?$/',
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

        if (count($avence) > 0) {
            session()->flash('error', 'This vente is Used as ForienKey in anthor Table');

        } else {

            $vente = Vente::where('id', $this->id_vente)->first();
            $client = Vente::where('client_id', $vente->id_client)->get();
            if (count($client) > 1) {
                $path = Storage::disk('local')->url($vente->contrat);
                File::delete(public_path($path));
                $valide = $vente->delete();
                if ($valide) {

                    if ($valide) {
                        session()->flash('message', 'vente bien supprimer ');
                    } else {
                        session()->flash('error', 'can\'t delete this vente cus is used as foreighn key ');
                    }
                }
            } else {

                $client = Client::where('id', $vente->id_client)->first();
                $path = Storage::disk('local')->url($vente->contrat);
                File::delete(public_path($path));
                $path = Storage::disk('local')->url($client->cin);
                File::delete(public_path($path));
                $valide = $vente->delete();
                if ($valide) {
                    $valide = $client->delete();
                    if ($valide) {
                        session()->flash('message', 'vente bien supprimer avec le client ');
                    } else {
                        session()->flash('error', 'can\'t delete this vente cus is used as foreighn key ');
                    }
                }
            }



        }

        $this->dispatchBrowserEvent('close-model');
    }



    //edit vente=====================

    public function editvente($id)
    {
        $vente = vente::where('id', $id)->first();
        $this->id_vente = $id;
        $this->titre = $vente->titre;
        $this->dateV = $vente->dateV;
        $this->contrat = $vente->contrat;
        $this->montant = $vente->montant;
        $this->montantReal = $vente->montantReal;
        $this->id_client = $vente->id_client;
        $this->id_bien = $vente->project_id;

    }

    public function editData()
    {

        $this->validate([
            'titre' => 'required',
            'dateV' => 'required|date',
            'id_bien' => 'required|integer',
            'id_client' => 'required|integer',
            'montant' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'montantReal' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        ]);

        $vente = vente::where('id', $this->id_vente)->first();
        $vente->titre = $this->titre;
        $vente->montant = $this->montant;
        $vente->montantReal = $this->montantReal;
        $vente->dateV = $this->dateV;
        $vente->id_client = $this->id_client;
        $vente->project_id = $this->id_bien;
        $valide = $vente->update();
        if ($valide) {
            $this->resetInputs();
            session()->flash('message', 'vente bien modifer');
        } else {
            session()->flash('error', 'can\'t update this vente');

        }

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

    // for add new avence from vente view 

    public function afficher($id)
    {
        $this->avences = Avence::where('id_vente', $id)->get();
        $vente = Vente::where('id', $id)->first();
        $this->name = $vente->client->name;
        $this->totalavence = $vente->paye;

    }

    public function addAvence($id)
    {
        $this->resetInputs();
        $vente = Vente::where('id', $id)->first();
        $this->clientname = $vente->client->name;
        $this->titre = $vente->titre;
        $this->id_vente = $id;
    }
    // add avence 
    public function saveAvence()
    {
        $this->validate([
            'montant' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'type' => 'required',
        ]);

        $vente = Vente::where('id', $this->id_vente)->first();
        $avence = new Avence();
        $avence->dateA = date('Y-m-d');
        $avence->id_client = $vente->id_client;
        $avence->id_vente = $vente->id;
        $avence->montant = $this->montant;
        $avence->type = $this->type;
        $valide = $avence->save();
        if ($valide) {
            $vente->paye = $vente->paye + $avence->montant;
            $vente->update();
            session()->flash('message', 'avence  bien Ajouter');
            $this->resetInputs();
        } else {
            session()->flash('error', 'You enterd invalid data please try again ');
        }

        $this->dispatchBrowserEvent('close-model');

    }


}