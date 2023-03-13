<?php

namespace App\Http\Livewire;

use App\Models\Avence;
use App\Models\Bien;
use App\Models\location;
use App\Models\Privente;
use App\Models\Vente;
use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use File;


class LocationList extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $id_bien,$id_location, $id_client,$contrat_pdf, $datedebut, $datefin, $prix_par_mois, $avance ,$cin,$name, $cin_client, $n_cin, $email, $ville_de_resi, $phone;
    public $cb_client=false;
    public $checked_id=[];
    public $selectAll = false;
    public $btndelete = true;
    public $sortname = "id";
    public $sortdrection = "DESC";
    public $pages = 5;
    public $search;


    public function render()
    {
        // 
        $this->btndelete = count($this->checked_id) < 1;
        $clients = Client::all();
        $biens = Bien::where('situation', 'disponible')->get();
        $locations = location::where('id', 'like', '%' . $this->search . '%')
            ->orWhereHas('bien' , function($query){$query->where('situation', 'like', '%' . $this->search . '%');})
            ->orWhereHas('client' , function($query){$query->where('name', 'like', '%' . $this->search . '%');})
            ->orderBy($this->sortname, $this->sortdrection)->paginate($this->pages, ['*'], 'new');
        return view('livewire.location-list', ['locations' => $locations, 'clients' => $clients,'biens'=>$biens]);
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
            'datedebut' => 'required|date',
            'datefin' => 'required|date',
            'prix_par_mois' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'avance' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'id_bien' => 'required|integer',
            'id_client' => 'required|integer',
            'contrat_pdf'=>'required|mimes:pdf',
            'cin_client'=>'required_if:cb_client,true|exists:clients,n_cin',
            'n_cin'=>'required_if:cb_client,false|unique:clients,n_cin',
            'cin'=>'required_if:cb_client,false|mimes:pdf',
            'name'=>'required_if:cb_client,false',
            'phone'=>'required_if:cb_client,false|regex:/[0-9]*/',
            'email'=>'email',
            
        ]);
     
        if($this->cb_client==false){
            $client=new Client();
            $client->name=$this->name;
            $client->n_cin=$this->n_cin;
            $client->email=$this->email;
            $client->ville_de_resi=$this->ville_de_resi;
            $client->phone  =$this->phone;
            $client->cin=$this->cin->store('Documents/client','public');
            $client->save();
            $this->id_client=$client->id;
        }elseif($this->cb_client==true){
            $this->id_client=Client::where('n_cin', $this->n_cin)->pluck('id')->first();
        }
        

        $location =new location();
        $location->id_bien=$this->id_bien;
        $location->datedebut=$this->datedebut;
        $location->datefin =$this->datefin;
        $location->montant=$this->prix_par_mois;
        $location->avance=$this->avance;
        $location->id_client=$this->id_client;
        $location->contrat_pdf=$this->contrat_pdf->store('Documents/location/contrat');
        $valide=$location->save();
        if ($valide) {
            Bien::where('id',$this->id_bien)->update(['situation'=>'location']);
            session()->flash('message', 'location bien ajouter');
            $this->dispatchBrowserEvent('add');
            $this->resetInputs();
        } else {
            session()->flash('error', 'invalide Data');

        }

        // for hidden the model
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-model');



    }

    private function resetInputs()
    {

        $this->datedebut="";
        $this->datefin="";
        $this->prix_par_mois="";
        $this->avance="";
        $this->id_client="";
        $this->id_bien="";
        $this->id_location="";
        $this->contrat_pdf="";


    }

    // validator function
    //   validation real -time
 



    // delete location

    public function deletelocation($id)
    {
   
        $this->id_location = $id;
    }

    public function deleteData()
    {

        $privente = Privente::where('id_location', $this->id_location)->get();
        $location = Location::where('id_location', $this->id_location)->get();
        $vente = Vente::where('id_location', $this->id_location)->get();

        if ( count($privente)>0 ||count($vente)>0 || count($location)>0) {
            session()->flash('error', 'This location is Used as ForienKey');

        } else {

            $location = location::where('id', $this->id_location)->first();
            $images=explode(',',$location->image);
            foreach($images as $img){
                $path = Storage::disk('local')->url($img);
                File::delete(public_path($path));
            }
            $valide=$location->delete();
            
            if ($valide) {
                
                if ($valide) {
                    session()->flash('message', 'le location deleted succefully');
                } else {
                    session()->flash('error', 'can\'t delete this location cus is used as foreighn key ');
                }
            }


        }

        $this->dispatchBrowserEvent('close-model');
    }



    //edit location=====================

    public function editlocation($id)
    {
        $location = location::where('id', $id)->first();
        $this->id_location = $id;
        $this->type_location = $location->type;
        $this->situation = $location->situation;
        $this->etage = $location->etage;
        $this->numero_location = $location->numero;
        $this->espace = $location->espace;
        $this->prix = $location->prix;
        $this->id_project = $location->id_project;
        $this->description = $location->description;

    }

    public function editData()
    {

        $this->validate([
            'type_location' => 'required',
            'prix' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'etage' => 'required',
            'numero_location' => 'required|integer',
            'espace'=>'required|regex:/[0-9]*/',
            'id_project'=>'required|integer',
            'situation'=>'required',
        ]);
       
       
        // dd(explode(',',$str));
        $location =location::where('id', $this->id_location)->first();
        $location->id_project=$this->id_project;
        $location->type=$this->type_location;
        $location->prix =$this->prix;
        $location->numero=$this->numero_location;
        $location->espace=$this->espace;
        $location->etage=$this->etage;
        $location->description=$this->description;
        $location->situation=$this->situation;
        $valide=$location->update();
        
        if ($valide) {
            
            session()->flash('message', 'le location modifer seccesfully');
        } else {
            session()->flash('error', 'can\'t update this location');

        }
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-model');
    }


    // delete check all boxs

    public function deletecheckedlocation()
    {


        $location = location::whereIn('location_id', $this->checked_id)->get();

        if (count($location) > 0) {
            session()->flash('error', 'This location is Used as ForienKey in anthor Table');
        } else {
            $locations = location::whereIn('id', $this->checked_id)->get();
            foreach ($locations as $location) {
                $path = Storage::disk('local')->url($location->cin);
                File::delete(public_path($path));
                $location->delete();
            }
            $this->checked_id = [];
            $this->selectAll = false;
            session()->flash('message', 'projet location supprimer');
            $this->resetInputs();
        }
        $this->dispatchBrowserEvent('close-model');

    }
    public function updatedselectAll($value)
    {
        if ($value) {
            $this->checked_id = location::pluck('id');

        } else {
            $this->checked_id = [];
            $this->btndelete = true;
        }
    }
    // end of check all boxs



    //  import location 

    public function importData()
    {
        $this->validate([

            'excelFile' => 'required|mimes:xlsx,xls',
        ]);
        // $path= $this->exelFile->store('documents/locationExcel','app');
        // $path = file_get_contents($path);
        session()->flash('message', 'locations location importer');

    }
    //  import project end

    // for add new avence from location view 

    public function afficher($id)
    {
        $this->avences = Avence::where('id_location', $id)->get();
        $location = location::where('id', $id)->first();
        $this->name = $location->client->name;
        $this->totalavence = $location->paye;

    }

    public function addAvence($id)
    {
        $this->resetInputs();
        $location = location::where('id', $id)->first();
        $this->clientname = $location->client->name;
        $this->titre = $location->titre;
        $this->id_location = $id;
    }
    // add avence 
    public function saveAvence()
    {
        $this->validate([
            'montant' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'type' => 'required',
        ]);

        $location = location::where('id', $this->id_location)->first();
        $avence = new Avence();
        $avence->dateA = date('Y-m-d');
        $avence->id_client = $location->id_client;
        $avence->id_location = $location->id;
        $avence->montant = $this->montant;
        $avence->type = $this->type;
        $valide = $avence->save();
        if ($valide) {
            $location->paye = $location->paye + $avence->montant;
            $location->update();
            session()->flash('message', 'avence  location Ajouter');
            $this->resetInputs();
        } else {
            session()->flash('error', 'You enterd invalid data please try again ');
        }

        $this->dispatchBrowserEvent('close-model');

    }


}