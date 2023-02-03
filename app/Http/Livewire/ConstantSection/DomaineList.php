<?php

namespace App\Http\Livewire\ConstantSection;

use Carbon\Traits\ToStringFormat;
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
    public $sortname='id';
    public $sortdrection = 'DESC';
    protected $listeners = ['saveData' => 'saveData'];
    // pagenation function 
    protected function updatingPages($value){
        $this->resetPage('new');
    }
    
    public function render()
    {
        $this->bulkDisabled = count($this->selectRows) < 1;
        $domaines=f_domaine::orderBy($this->sortname, $this->sortdrection)->paginate($this->pages, ['*'], 'new');
        return view('livewire.constant-section.domaine-list',['domaines'=>$domaines]);
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
        session()->flash('error','le domaine used in fournisseur table ');
  
       }
        
    }

    // delete selected rows on the table 
    public function  deleteSelectedRows(){
    
    $id = [];
    $deleted = [];
    $domaines = f_domaine::query()->whereIn('id', $this->selectRows)->get();
    foreach($domaines as $domaine){
        try{
            $domaine = f_domaine::where('id',$domaine->id)->first();
            $domaine->delete();
            $deleted[]=$domaine->id;
        }catch(QueryException $ex){
                $id[]=$domaine->id;
        }
    }
    if (count($deleted) > 0) {
        session()->flash('message', "Deleted seccesfully Domaine of Id=[" . implode(",", $deleted) . "]");
    }
    if(count($id)>0){
        session()->flash('error', "Can't delete Domaine of Id=[" . implode(",", $id) . "] Because is Used as ForeignKey ");
    }
    $this->selectRows = $id ;
    $this->selectAll = false;
    $id = [];
    $deleted = [];
   
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
