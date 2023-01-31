<?php

namespace App\Http\Livewire\RhSection;

use Livewire\Component;
use App\Models\Bureau;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use \Illuminate\Database\QueryException;

class BureauList extends Component
{
  
    use WithFileUploads;
    use WithPagination;
    public $name,$ville,$phone,$id_bureau;
    public $selectRows = [];
    public $selectAll = false;
    public $bulkDisabled = true;
    public $pages = 5;
    protected $listeners = ['saveData' => 'saveData'];
    
    public function render()
    {
        $this->bulkDisabled = count($this->selectRows) < 1;
        $bureaus=Bureau::all();
        return view('livewire.rh-section.bureau-list',['bureaus'=>$bureaus]);
    }
    public function updated($fields){
        $this->validateOnly($fields,[
            'name'=>'required',
            'ville'=>'required',
            'phone'=>'required|integer',
        ]);
    }
    // this function for reset inputs
    public function resetInputs(){
        $this->name="";
        $this->phone="";
        $this->ville="";
    }


    //save data function
    public function saveData(){
        $this->validate([
            'name'=>'required',
            'ville'=>'required',
            'phone'=>'required|integer',
           
        ]);
        $bureau = new Bureau;
        $bureau->nom = $this->name;     
        $bureau->ville = $this->ville;     
        $bureau->phone = $this->phone;     
      
        $bureau->save();
        session()->flash('message','bureau bien ajouter');
        
        // for empty input fields after validation
         
        $this->resetInputs();
        
        $this->dispatchBrowserEvent('add');

        // for hidden the model
        $this->dispatchBrowserEvent('close-model');
       

    }
    // edit data of a row 
    public function edit($id){
        $bureau = Bureau::where('id',$id)->first();
        $this->id_bureau = $id;
        $this->name = $bureau->nom;
        $this->ville = $bureau->ville;
        $this->phone = $bureau->phone;
    }
    
    public function editData(){
        $bureau = Bureau::where('id',$this->id_bureau)->first();
        $bureau->nom = $this->name;
        $bureau->ville = $this->ville;
        $bureau->phone = $this->phone;
        $bureau->save();
        session()->flash('message','bureau bien modifer');
        $this->dispatchBrowserEvent('close-model');
    }
   

    // delete data row 

    public function delete($id){
        $bureau = Bureau::where('id',$id)->first();
        $this->id_bureau = $id;
        $this->name = $bureau->nom;
        $this->ville = $bureau->ville;
        $this->phone = $bureau->phone;
        
    }
    
    public function deleteData(){
       try{
        $bureau = Bureau::where('id',$this->id_bureau)->first();
        $bureau->delete();
        session()->flash('message','bureau bien supprimer');
        $this->dispatchBrowserEvent('add');
        $this->dispatchBrowserEvent('close-model');
       }catch(QueryException $e){
        session()->flash('error','error');

       }
        
    }

    // delete selected rows on the table 
    public function  deleteSelectedRows(){
        try{
            Bureau::query()
            ->whereIn('id',$this->selectRows)
            ->delete();
            $this->selectRows = [];
           $this->selectAll = false;
        }catch(QueryException $e){
            session()->flash('error','error');
            

        }
   
   }
   
   
   public function updatedSelectAll($value){
   if($value){
       $this->selectRows = Bureau::pluck('id');
   }else{
       $this->selectRows = [];
   }
   }
}
