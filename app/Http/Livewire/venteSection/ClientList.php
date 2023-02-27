<?php

namespace App\Http\Livewire\VenteSection;

use App\Models\Avence;
use App\Models\Depense;
use App\Models\Vente;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\client;
use App\Imports\Importclient;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use File;


class ClientList extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $name,$cin,$n_cin,$email,$ville_de_resi,$phone,$id_client,$excelFile;

    public $checked_id=[];
    public $selectAll=false;
    public $btndelete=true;
    public $sortname="id";
    public $sortdrection="DESC";
    public $pages = 5;
    public $search;
    protected $listeners = ['saveData' => 'saveData'];

   

    public function render()
    {
        $this->btndelete=count($this->checked_id)<1;
        $clients=client::where('name', 'like', '%'.$this->search.'%')
        ->orWhere('n_cin', 'like', '%'.$this->search.'%')
        ->orderBy($this->sortname, $this->sortdrection)->paginate($this->pages, ['*'], 'new');
        return view('livewire.vente-section.client-list',['clients'=>$clients]);
    }

     // sort function  for order data by table head 
    public function sort($value){
        if($this->sortname==$value && $this->sortdrection=="DESC"){
            $this->sortdrection="ASC";
        }
        else{
            if($this->sortname==$value && $this->sortdrection=="ASC"){
                $this->sortdrection="DESC";
            }
        }
        $this->sortname=$value;

    }

    // for paginate
    public function updatingPages($value){
        $this->resetPage('new');
        
    }

    public function saveData(){
       
        $this->validate([
           'name'=>'required',
           'cin'=>'mimes:pdf',
           'n_cin'=>'required|regex:/([a-zA-Z]{2})([0-9]{6})/',
           'phone'=>'required|regex:/[0-9]*/',
           
        ]);

        $cinfile=$this->cin->store('Documents/client','public');
        $client=new client();
        $client->name=$this->name;
        $client->cin=$cinfile;
        $client->n_cin=$this->n_cin;
        $client->phone=$this->phone;
        $client->email=$this->email;
        $client->ville_de_resi=$this->ville_de_resi;

        $client->save();
        $this->resetInputs();
        session()->flash('message','client bien ajouter');
        $this->dispatchBrowserEvent('add');

        // for hidden the model
        $this->dispatchBrowserEvent('close-model');
        


    }

    private function resetInputs(){

        $this->name="";
        $this->cin="";
        $this->n_cin="";
        $this->email="";
        $this->phone="";
        $this->ville_de_resi="";
        $this->id_client="";
      

    }

    // validator function
    //   validation real -time
    public function updated($fields){
        $this->validateOnly($fields,[
            'name'=>'required',
            'cin'=>'required|mimes:pdf',
            'n_cin'=>'required|regex:/([a-zA-Z]{2})([0-9]{6})/',
            'phone'=>'required|regex:/[0-9]*/',
            'email'=>'email',
        ]);
    }



// delete client

    public function deleteclient($id){
       
        $this->id_client = $id;
    }

    public function deleteData(){

        $vente= Vente::where('client_id',$this->id_client)->get();
        $avence= Avence::where('id_client',$this->id_client)->get();

        if(count($vente)>0 || count($avence)>0){
            session()->flash('error','This client is Used as ForienKey');

        }
        else{
            $client = client::where('id',$this->id_client)->first();
            $path=Storage::disk('local')->url($client->cin);
            File::delete(public_path($path));
            $client->delete();
            session()->flash('message','client bien supprimer ');
            $this->dispatchBrowserEvent('add');
        }
        
        $this->dispatchBrowserEvent('close-model');
    }


    
   //edit client=====================

    public function editclient($id){
        $client = client::where('id',$id)->first();
        $this->id_client = $id; 
        $this->name= $client->name;
        $this->cin = $client->cin;
        $this->n_cin = $client->n_cin;
        $this->phone= $client->phone;
        $this->email=$client->email;
        $this->ville_de_resi=$client->ville_de_resi;
        
    }

    public function editData(){
        $this->validate([
            'name'=>'required',
            'cin'=>'required|mimes:pdf',
            'n_cin'=>'required|unique:clients',
            'phone'=>'required|regex:/[0-9]*/',
            'email'=>'email',
            
         ]);

        $client = client::where('id',$this->id_client)->first();
        $client->name=$this->name;
        $client->n_cin=$this->n_cin;
        $client->phone=$this->phone;
        $client->email=$this->email;
        $client->ville_de_resi=$this->ville_de_resi;
        $client->update();
        $this->resetInputs();
        session()->flash('message','client bien modifer');
        $this->dispatchBrowserEvent('close-model');
    }


    // delete check all boxs

    public function deletecheckedclient(){


        $vente= Vente::whereIn('client_id',$this->checked_id)->get();
        $avence= Avence::where('id_client',$this->id_client)->get();


        if(count($vente)>0 || count($avence)>0){
            session()->flash('error','This client is Used as ForienKey');
        }else{
            $clients=client::whereIn('id',$this->checked_id)->get();
            foreach($clients as $client){
                $path = Storage::disk('local')->url($client->cin);
                File::delete(public_path($path));
                $client->delete();
            }
            $this->checked_id = [];
            $this->selectAll = false;
            session()->flash('message', 'projet bien supprimer');
            $this->resetInputs();
        }
        $this->dispatchBrowserEvent('close-model');
        
    }
    public function updatedselectAll($value){
        if($value){
            $this->checked_id=client::pluck('id');
        
        }
        else{
            $this->checked_id=[];
            $this->btndelete=true;
        }
    }
    // end of check all boxs



    //  import client 

    public function importData(){
        $this->validate([
           
            'excelFile'=>'required|mimes:xlsx,xls',
        ]);
        // $path= $this->exelFile->store('documents/clientExcel','app');
        // $path = file_get_contents($path);
        session()->flash('message','clients bien importer');
        
     }
//  import project end


}
