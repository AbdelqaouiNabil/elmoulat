<?php

namespace App\Http\Livewire\RhSection;

use Livewire\Component;
use App\Models\Employe;
use App\Models\Bureau;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use \Illuminate\Database\QueryException;

class EmployeList extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $nom,$bureau_id,$prenom,$phone,$datedubet,$contrat,$designiation,$salaire ,$id_employe;
    public $selectRows = [];
    public $selectAll = false;
    public $bulkDisabled = true;
    public $pages = 5;
   
    
    public function render()
    {
        $this->bulkDisabled = count($this->selectRows) < 1;
        $employes=Employe::all();
        $bureaus=Bureau::all();
        return view('livewire.rh-section.employe-list',['employes'=>$employes,'bureaus'=>$bureaus]);
    }
    public function updated($fields){
        $this->validateOnly($fields,[
            'nom'=>'required',
            'prenom'=>'required',
            'phone'=>'required|integer',
            'datedubet'=>'required|date',
            'contrat'=>'required',
            'salaire'=>'required',
            'bureau_id'=>'required|integer',

        ]);
    }
    // this function for reset inputs
    public function resetInputs(){
        $this->nom="";
        $this->prenom="";
        $this->phone="";
        $this->datedubet="";
        $this->contrat="";
        $this->designiation="";
        $this->bureau_id="";
        $this->salaire="";
        
    }


    //save data function
    public function saveData(){
        $this->validate([
            
            'nom'=>'required',
            'prenom'=>'required',
            'phone'=>'required|integer',
            'datedubet'=>'required|date',
            'contrat'=>'required',
            'salaire'=>'required',
            'bureau_id'=>'required|integer',
           
        ]);
        $employe = new Employe;
        
        $employe->nom = $this->nom;     
        $employe->prenom = $this->prenom;     
        $employe->phone = $this->phone;     
        $employe->datedubet = $this->datedubet;     
        $employe->contrat = $this->contrat;     
        $employe->salaire = $this->salaire;     
        $employe->designiation = $this->designiation;     
        $employe->bureau_id = $this->bureau_id;     
        $employe->save();
        session()->flash('message','employe bien ajouter');
        
        // for empty input fields after validation
         
        $this->resetInputs();
        
        $this->dispatchBrowserEvent('add');

        // for hidden the model
        $this->dispatchBrowserEvent('close-model');
       

    }
    // edit data of a row 
    public function edit($id){
        $employe = Employe::where('id',$id)->first();
        $this->id_employe = $id;
        $this->nom=$employe->nom;
        $this->prenom=$employe->prenom;
        $this->phone=$employe->phone;
        $this->datedubet=$employe->datedubet;
        $this->contrat=$employe->contrat;
        $this->designiation=$employe->designiation;
        $this->bureau_id=$employe->bureau_id;
        $this->salaire=$employe->salaire;
       
     
    }
    
    public function editData(){
        $employe = Employe::where('id',$this->id_employe)->first();
        $employe->bureau_id = $this->bureau_id;     
        $employe->nom = $this->nom;     
        $employe->prenom = $this->prenom;     
        $employe->phone = $this->phone;     
        $employe->datedubet = $this->datedubet;     
        $employe->contrat = $this->contrat;     
        $employe->salaire = $this->salaire;     
        $employe->designiation = $this->designiation;
        $employe->save();
        session()->flash('message','employe bien modifer');
        $this->dispatchBrowserEvent('close-model');
    }
   

    // delete data row 

    public function delete($id){
        $employe = Employe::where('id',$id)->first();
        $this->id_employe = $id;
        $this->nom=$employe->nom;
        $this->prenom=$employe->prenom;
        $this->phone=$employe->phone;
        $this->datedubet=$employe->datedubet;
        $this->contrat=$employe->contrat;
        $this->designiation=$employe->designiation;
        $this->bureau_id=$employe->bureau_id;
        $this->salaire=$employe->salaire;
    }
    
    public function deleteData(){
       try{
        $employe = Employe::where('id',$this->id_employe)->first();
        $employe->delete();
        session()->flash('message','employe bien supprimer');
        $this->dispatchBrowserEvent('add');
        $this->dispatchBrowserEvent('close-model');
       }catch(QueryException $e){
        session()->flash('error','error');

       }
        
    }

    // delete selected rows on the table 
    public function  deleteSelectedRows(){
        try{
            Employe::query()
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
       $this->selectRows = Employe::pluck('id');
   }else{
       $this->selectRows = [];
   }
   }
}
