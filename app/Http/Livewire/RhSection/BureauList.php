<?php

namespace App\Http\Livewire\RhSection;

use App\Models\Employe;
use App\Models\Projet;
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
            'phone'=>'required|regex:/[0-9]*/',
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
            'phone'=>'required|regex:/[0-9]*/',
           
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

        $this->validate([
            'name'=>'required',
            'ville'=>'required',
            'phone'=>'required|regex:/[0-9]*/',
           
        ]);
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
        $this->id_bureau = $id;
     
    }
    
    public function deleteData(){
            $check= Employe::where('bureau_id',$this->id_bureau)->first();
            $check2 = Projet::where('id_bureau', $this->id_bureau)->first();
        if($check || $check2){
            session()->flash('error','this Bureau is aready used  as ForingKey');
            return;
            
        }else {
            $bureau = Bureau::where('id', $this->id_bureau)->first();
            $bureau->delete();
            session()->flash('message', 'les bureau bien supprimer');
            $this->resetInputs();
            $this->dispatchBrowserEvent('add');
        }
        
    }

    // delete selected rows on the table 
    public function  deleteSelectedRows(){

      
        $employe = Employe::whereIn('bureau_id', $this->selectRows)->get();
        $projet = Projet::whereIn('id_bureau', $this->selectRows)->get();

        if (count($projet)>0 || count($employe)>0 ) {
            session()->flash('error', 'there is one or more bureaus is aready used  as ForingKey ');
            return;
        } else {
            $bureau = Bureau::whereIn('id', $this->selectRows);
            $bureau->delete();
            session()->flash('message', 'les bureau bien supprimer');
            $this->selectRows=[];
            $this->selectAll=false;
        }
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-model');
   }
   
   
   public function updatedSelectAll($value){
   if($value){
       $this->selectRows = Bureau::pluck('id');
   }else{
       $this->selectRows = [];
   }
   }
}
