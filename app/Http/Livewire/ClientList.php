<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Client;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithPagination;

class ClientList extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $name , $n_cin, $cin ,$email , $phone ,$ville_de_resi ,$id_client;
    public $exelFile;
    public $selectedClients = [];
    public $selectAll = false;
    public $bulkDisabled = true;
    public $pages = 5;
    protected $listeners = ['saveData' => 'saveData'];

    
    public function render()
    {
        
        $this->bulkDisabled = count($this->selectedClients) < 1;
        $clients = Client::orderBy('id', 'DESC')->paginate($this->pages);
        return view('livewire.client-list',['clients'=>$clients]);
    }

//   validation real -time
    public function updated($fields){
        $this->validateOnly($fields,[
             'name'=>'required',            
             'cin'=>'required',
             'n_cin'=>'required',
             'email'=>'required',
             'phone'=>'required|integer',
             'ville_de_resi'=>'required',
            
        ]);
    }

// save Client start
    public function saveData(){
        $this->validate([
            'name'=>'required',            
            'cin'=>'required',
            'n_cin'=>'required',
            'email'=>'required',
            'phone'=>'required|integer',
            'ville_de_resi'=>'required',
        ]);
        $cinfile=$this->cin->store('Documents/Client','public');
        
        
        $client = new Client;
        $client->name = $this->name;     
        $client->cin = $cinfile;
        $client->n_cin = $this->n_cin;
        $client->phone  = $this->phone ;
        $client->email  = $this->email ;
        $client->ville_de_resi = $this->ville_de_resi;
    
        $client->save();
        session()->flash('message','Client bien ajouter');
        
        // for empty input fields after validation
         
       $this->resetInputs();
        
        $this->dispatchBrowserEvent('add');

        // for hidden the model
        $this->dispatchBrowserEvent('close-model');
       

    }
// save project end
//  edit project

public function resetInputs(){
        
        $this->name = "";
        $this->cin = "";
        $this->n_cin = "";
        $this->phone = "" ;
        $this->email  = "";
        $this->ville_de_resi = "";      
        $this->id_client = "";
}

 public function editClient($id){
       
        
        $client = Client::where('id',$id)->first();
       
        $this->id_client = $client->id;    
        $this->name= $client->name;
        $this->cin = $client->cin;
        $this->n_cin = $client->n_cin;
        $this->email = $client->email;
        $this->phone = $client->phone;
        $this->ville_de_resi = $client->ville_de_resi ;
    
        
    }
    
    public function editData(){
        $client = Client::where('id',$this->id_client)->first();
      
        $client->name = $this->name;
        $client->ville_de_resi = $this->ville_de_resi;
        $client->n_cin  = $this->n_cin ;
        $client->email  = $this->email ;
        $client->phone = $this->phone;
        $client->cin =  $this->cin;
      
        $client->save();
        session()->flash('message','Client bien modifer');
        $this->dispatchBrowserEvent('close-model');
    }

//  delete Client start

    public function deleteClient($id){
        $client = Client::where('id',$id)->first();
        
        $this->id_client = $id;    
        $this->name= $client->name;
        $this->cin = $client->cin;
        $this->n_cin = $client->n_cin;
        $this->email = $client->email;
        $this->phone = $client->phone;
        $this->ville_de_resi = $client->ville_de_resi ;
    }
    
    public function deleteData(){
        
        $client = Client::where('id',$this->id_client)->first();
        Storage::delete($this->cin);
        $client->delete();
        session()->flash('message','Client bien supprimer');
        $this->dispatchBrowserEvent('add');
        $this->dispatchBrowserEvent('close-model');
        
    }
//  delete project end
// delete multiple projects start


public function  deleteSelected(){
    Client::query()
        ->whereIn('id',$this->selectedClients)
        ->delete();

    $this->selectedClient= [];
    $this->selectAll = false;
    
}
 public function updatedSelectAll($value){
    if($value){
        $this->selectedClients = Client::pluck('id');
    }else{
        $this->selectedClients = [];
    }
 }

// delete multiple projects end
//  import project start

     public function importData(){
        $this->validate([
           
            'exelFile'=>'required|mimes:xlsx,xls',
        ]);

    

       
        // $path = file_get_contents($tt);
        
            $path= $this->exelFile->store('','app');
            Excel::import(new ProjetsImport($this->exelFile,$path),$path);
            session()->flash('message','projet bien imposter');
        
        
     }
//  import project end


}

