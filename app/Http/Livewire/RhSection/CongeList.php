<?php

namespace App\Http\Livewire\RhSection;

use Livewire\Component;
use App\Models\Employe;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use \Illuminate\Database\QueryException;
class CongeList extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $datedubet,$datefin,$jours,$type,$id_conge,$employe_id;
    public $selectRows = [];
    public $selectAll = false;
    public $bulkDisabled = true;
    public $pages = 5;
    protected $listeners = ['saveData' => 'saveData'];
    
    public function render()
    {
        $this->bulkDisabled = count($this->selectRows) < 1;
        $conges=Conge::all();
        return view('livewire.rh-section.conge-list',['conges'=>$conges]);
    }
    public function updated($fields){
        $this->validateOnly($fields,[
            'datedebut'=>'required|date',
            'datedebut'=>'required|date',
            'jours'=>'required|integer',
            'id_imploye'=>'required|integer',
            'type'=>'required',
        ]);
    }
    // this function for reset inputs
    public function resetInputs(){
        $this->datedubet="";
        $this->datefin="";
        $this->jours="";
        $this->employe_id="";
        $this->type="";
    }


    //save data function
    public function saveData(){
        $this->validate([
            'datedebut'=>'required|date',
            'datedebut'=>'required|date',
            'jours'=>'required|integer',
            'id_imploye'=>'required|integer',
            'type'=>'required',
           
        ]);
        $conge = new Conge;
        $conge->datedubet = $this->datedubet;     
        $conge->datefin = $this->datefin;     
        $conge->jours = $this->jours;     
        $conge->type = $this->type;     
        $conge->employe_id = $this->employe_id;     
      
        $conge->save();
        session()->flash('message','conge bien ajouter');
        
        // for empty input fields after validation
         
        $this->resetInputs();
        
        $this->dispatchBrowserEvent('add');

        // for hidden the model
        $this->dispatchBrowserEvent('close-model');
       

    }
    // edit data of a row 
    public function edit($id){
        $conge = Conge::where('id',$id)->first();
        $this->id_conge = $id;
        $this->datedubet=$conge->datedubet;
        $this->datefin=$conge->datefin;
        $this->jours=$conge->jours;
        $this->employe_id=$conge->employe_id;
        $this->type=$conge->type;
    }
    
    public function editData(){
        $conge = Conge::where('id',$this->id_conge)->first();
        $conge->datedubet = $this->datedubet;     
        $conge->datefin = $this->datefin;     
        $conge->jours = $this->jours;     
        $conge->type = $this->type;     
        $conge->employe_id = $this->employe_id;
        $conge->save();
        session()->flash('message','conge bien modifer');
        $this->dispatchBrowserEvent('close-model');
    }
   

    // delete data row 

    public function delete($id){
        $conge = Conge::where('id',$id)->first();
        $this->id_conge = $id;
        $this->datedubet=$conge->datedubet;
        $this->datefin=$conge->datefin;
        $this->jours=$conge->jours;
        $this->employe_id=$conge->employe_id;
        $this->type=$conge->type;
        
    }
    
    public function deleteData(){
       try{
        $conge = Conge::where('id',$this->id_conge)->first();
        $conge->delete();
        session()->flash('message','conge bien supprimer');
        $this->dispatchBrowserEvent('add');
        $this->dispatchBrowserEvent('close-model');
       }catch(QueryException $e){
        session()->flash('error','error');

       }
        
    }

    // delete selected rows on the table 
    public function  deleteSelectedRows(){
        try{
            Conge::query()
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
       $this->selectRows = conge::pluck('id');
   }else{
       $this->selectRows = [];
   }
   }
}
