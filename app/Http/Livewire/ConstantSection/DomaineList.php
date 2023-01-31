<?php

namespace App\Http\Livewire\ConstantSection;

use Livewire\Component;
use App\Models\f_domaine;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use \Illuminate\Database\QueryException;
class DomaineList extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $name,$id_domaine;
    public $selectRows = [];
    public $selectAll = false;
    public $bulkDisabled = true;
    public $pages = 5;
    protected $listeners = ['saveData' => 'saveData'];
    
    public function render()
    {
        $this->bulkDisabled = count($this->selectRows) < 1;
        $domaines=f_domaine::all();
        return view('livewire.constant-section.domaine-list',['domaines'=>$domaines]);
    }
    public function updated($fields){
        $this->validateOnly($fields,[
            'name'=>'required',
        ]);
    }
    // this function for reset inputs
    public function resetInputs(){
        $this->name="";
    }


    //save data function
    public function saveData(){
        $this->validate([
            'name'=>'required',
           
        ]);
        $domaine = new f_domaine;
        $domaine->name = $this->name;     
        $domaine->save();
        session()->flash('message','domaine bien ajouter');
        
        // for empty input fields after validation
         
        $this->resetInputs();
        
        $this->dispatchBrowserEvent('add');

        // for hidden the model
        $this->dispatchBrowserEvent('close-model');
       

    }
    // edit data of a row 
    public function edit($id){
        $domaine = f_domaine::where('id',$id)->first();
        $this->id_domaine = $id;
        $this->name = $domaine->name;
       
     
    }
    
    public function editData(){
        $domaine = f_domaine::where('id',$this->id_domaine)->first();
        $domaine->name = $this->name;
        $domaine->save();
        session()->flash('message','domaine bien modifer');
        $this->dispatchBrowserEvent('close-model');
    }
   

    // delete data row 

    public function delete($id){
        $domaine = f_domaine::where('id',$id)->first();
        $this->id_domaine = $id;
        $this->name = $domaine->name;
    }
    
    public function deleteData(){
       try{
        $domaine = f_domaine::where('id',$this->id_domaine)->first();
        $domaine->delete();
        session()->flash('message','domaine bien supprimer');
        $this->dispatchBrowserEvent('add');
        $this->dispatchBrowserEvent('close-model');
       }catch(QueryException $e){
        session()->flash('error','le domaine used in fournisseur table');

       }
        
    }

    // delete selected rows on the table 
    public function  deleteSelectedRows(){
        try{
            f_domaine::query()
            ->whereIn('id',$this->selectRows)
            ->delete();
            $this->selectRows = [];
           $this->selectAll = false;
        }catch(QueryException $e){
            session()->flash('error','le domaine used in fournisseur table');
            

        }
   
   }
   
   
   public function updatedSelectAll($value){
   if($value){
       $this->selectRows = f_domaine::pluck('id');
   }else{
       $this->selectRows = [];
   }
   }

//    get domaine name 



}
