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
    public $sortname="id";
    public $sortdrection="DESC";
    public $pages = 5;
    protected $listeners = ['saveData' => 'saveData'];
    
    public function render()
    {
        $this->bulkDisabled = count($this->selectRows) < 1;
        $bureaus=Bureau::orderBy($this->sortname,$this->sortdrection)->paginate($this->pages,['*'],'new');
        return view('livewire.rh-section.bureau-list',['bureaus'=>$bureaus]);
    }
    // sort function 
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
        $this->resetInputs();
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
        session()->flash('error','Id Bureau used as foreingKey');
       }
       $this->resetInputs();
        
    }

    // delete selected rows on the table 
    public function  deleteSelectedRows(){
    
        $id = [];
        $deleted = [];
        $bureaus = Bureau::query()->whereIn('id', $this->selectRows)->get();
        foreach ($bureaus as $bureau) {
            try {
                $bureau = Bureau::where('id', $bureau->id)->first();
                $bureau->delete();
                $deleted[] = $bureau->id;
            } catch (QueryException $ex) {
                $id[] = $bureau->id;
            }
        }
        if (count($deleted) > 0) {
            session()->flash('message', "Deleted seccesfully Bureau of Id=[" . implode(",", $deleted) . "]");
        }
        if (count($id) > 0) {
            session()->flash('error', "Can't delete Bureau of Id=[" . implode(",", $id) . "] Because is Used as ForeignKey ");
        }
        $this->selectRows = $id;
        $this->selectAll = false;
        $id = [];
        $deleted = [];
        $this->resetInputs();
   
   }
   
   
   public function updatedSelectAll($value){
   if($value){
       $this->selectRows = Bureau::pluck('id');
   }else{
       $this->selectRows = [];
   }
   }
}
