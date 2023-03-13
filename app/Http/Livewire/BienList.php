<?php

namespace App\Http\Livewire;

use App\Models\Avence;
use App\Models\Bien;
use App\Models\Location;
use App\Models\Privente;
use App\Models\Projet;
use App\Models\Vente;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use File;


class BienList extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $type_bien, $situation, $prix, $image, $etage, $numero_bien,$espace,$description, $id_bien, $id_project;

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
        $projects = Projet::all();
        $biens = bien::where('type', 'like', '%' . $this->search . '%')
            ->orwhere('situation', 'like','%'.$this->search.'%')
            ->orWhereHas('project' , function($query){$query->where('name', 'like', '%' . $this->search . '%');})
            ->orderBy($this->sortname, $this->sortdrection)->paginate($this->pages, ['*'], 'new');
        return view('livewire.bien-list', ['biens' => $biens, 'projects' => $projects,]);
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
            'type_bien' => 'required',
            'prix' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'etage' => 'required',
            'numero_bien' => 'required|integer',
            'espace'=>'required|regex:/[0-9]*/',
            'id_project'=>'required|integer',
            'image'=>'required|array',
            'image.*'=>'image|mimes:jpeg,jpg,png|max:2000',
            
            
        ]);
        $images=[];
        foreach($this->image as $img){
            
            $path=$img->store('Documents/bien/images', 'public');
            array_push($images,$path);
            
            
        }
       
        $bien =new Bien();
        $bien->id_project=$this->id_project;
        $bien->type=$this->type_bien;
        $bien->prix =$this->prix;
        $bien->numero=$this->numero_bien;
        $bien->espace=$this->espace;
        $bien->etage=$this->etage;
        $bien->description=$this->description;
        $bien->image = implode(',',$images);
        $valide=$bien->save();
        if ($valide) {
            session()->flash('message', 'bien bien ajouter');
            $this->dispatchBrowserEvent('add');
            $this->resetInputs();
        } else {
            session()->flash('error', 'you enterd rong type of data');

        }
        // for hidden the model
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-model');



    }

    private function resetInputs()
    {

        $this->type_bien="";
        $this->numero_bien="";
        $this->prix="";
        $this->situation="";
        $this->id_bien="";
        $this->id_project="";
        $this->espace="";
        $this->image="";


    }

    // validator function
    //   validation real -time
 



    // delete bien

    public function deletebien($id)
    {
   
        $this->id_bien = $id;
    }

    public function deleteData()
    {

        $privente = Privente::where('id_bien', $this->id_bien)->get();
        $location = Location::where('id_bien', $this->id_bien)->get();
        $vente = Vente::where('id_bien', $this->id_bien)->get();

        if ( count($privente)>0 ||count($vente)>0 || count($location)>0) {
            session()->flash('error', 'This bien is Used as ForienKey');

        } else {

            $bien = bien::where('id', $this->id_bien)->first();
            $images=explode(',',$bien->image);
            foreach($images as $img){
                $path = Storage::disk('local')->url($img);
                File::delete(public_path($path));
            }
            $valide=$bien->delete();
            
            if ($valide) {
                
                if ($valide) {
                    session()->flash('message', 'le bien deleted succefully');
                } else {
                    session()->flash('error', 'can\'t delete this bien cus is used as foreighn key ');
                }
            }


        }

        $this->dispatchBrowserEvent('close-model');
    }



    //edit bien=====================

    public function editbien($id)
    {
        $bien = bien::where('id', $id)->first();
        $this->id_bien = $id;
        $this->type_bien = $bien->type;
        $this->situation = $bien->situation;
        $this->etage = $bien->etage;
        $this->numero_bien = $bien->numero;
        $this->espace = $bien->espace;
        $this->prix = $bien->prix;
        $this->id_project = $bien->id_project;
        $this->description = $bien->description;

    }

    public function editData()
    {

        $this->validate([
            'type_bien' => 'required',
            'prix' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'etage' => 'required',
            'numero_bien' => 'required|integer',
            'espace'=>'required|regex:/[0-9]*/',
            'id_project'=>'required|integer',
            'situation'=>'required',
        ]);
       
       
        // dd(explode(',',$str));
        $bien =bien::where('id', $this->id_bien)->first();
        $bien->id_project=$this->id_project;
        $bien->type=$this->type_bien;
        $bien->prix =$this->prix;
        $bien->numero=$this->numero_bien;
        $bien->espace=$this->espace;
        $bien->etage=$this->etage;
        $bien->description=$this->description;
        $bien->situation=$this->situation;
        $valide=$bien->update();
        
        if ($valide) {
            
            session()->flash('message', 'le bien modifer seccesfully');
        } else {
            session()->flash('error', 'can\'t update this bien');

        }
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-model');
    }


    // delete check all boxs

    public function deletecheckedbien()
    {


        $bien = bien::whereIn('bien_id', $this->checked_id)->get();

        if (count($bien) > 0) {
            session()->flash('error', 'This bien is Used as ForienKey in anthor Table');
        } else {
            $biens = bien::whereIn('id', $this->checked_id)->get();
            foreach ($biens as $bien) {
                $path = Storage::disk('local')->url($bien->cin);
                File::delete(public_path($path));
                $bien->delete();
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
            $this->checked_id = bien::pluck('id');

        } else {
            $this->checked_id = [];
            $this->btndelete = true;
        }
    }
    // end of check all boxs



    //  import bien 

    public function importData()
    {
        $this->validate([

            'excelFile' => 'required|mimes:xlsx,xls',
        ]);
        // $path= $this->exelFile->store('documents/bienExcel','app');
        // $path = file_get_contents($path);
        session()->flash('message', 'biens bien importer');

    }
    //  import project end

    // for add new avence from bien view 

    public function afficher($id)
    {
        $this->avences = Avence::where('id_bien', $id)->get();
        $bien = bien::where('id', $id)->first();
        $this->name = $bien->client->name;
        $this->totalavence = $bien->paye;

    }

    public function addAvence($id)
    {
        $this->resetInputs();
        $bien = bien::where('id', $id)->first();
        $this->clientname = $bien->client->name;
        $this->titre = $bien->titre;
        $this->id_bien = $id;
    }
    // add avence 
    public function saveAvence()
    {
        $this->validate([
            'montant' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'type' => 'required',
        ]);

        $bien = bien::where('id', $this->id_bien)->first();
        $avence = new Avence();
        $avence->dateA = date('Y-m-d');
        $avence->id_client = $bien->id_client;
        $avence->id_bien = $bien->id;
        $avence->montant = $this->montant;
        $avence->type = $this->type;
        $valide = $avence->save();
        if ($valide) {
            $bien->paye = $bien->paye + $avence->montant;
            $bien->update();
            session()->flash('message', 'avence  bien Ajouter');
            $this->resetInputs();
        } else {
            session()->flash('error', 'You enterd invalid data please try again ');
        }

        $this->dispatchBrowserEvent('close-model');

    }


}