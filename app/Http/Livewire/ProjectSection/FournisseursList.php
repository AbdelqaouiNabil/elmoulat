<?php

namespace App\Http\Livewire\ProjectSection;

use Livewire\Component;
use App\Models\f_domaine;
use App\Models\Fournisseur;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use DB;

class FournisseursList extends Component
{


    use WithFileUploads;
    use WithPagination;

    public $name , $ice, $phone ,$email,$adress, $id_fournisseur, $id_fdomaine,$sorttype;
    public $excelFile;
    public $selectedfournisseur = [];
    public $selectAll = false;
    public $bulkDisabled = true;
    public $pages = 5;
    protected $listeners = ['saveData' => 'saveData'];
    public $sortby="id";

    public function updatePages($value){
        $this->resetPages('new');

    }

    public function render()
    {
        $this->bulkDisabled = count($this->selectedfournisseur) < 1;

        if($this->sorttype!="" && $this->sorttype!="id" ){
            $fournisseurs =Fournisseur::where('id_fdomaine',$this->sorttype)->paginate($this->pages,['*'],'new');


        }elseif($this->sorttype=="id"){
            $fournisseurs = Fournisseur::orderBy('id', 'DESC')->paginate($this->pages,['*'],'new');

        }
        else{
            $fournisseurs = Fournisseur::orderBy('id', 'DESC')->paginate($this->pages,['*'],'new');

        }
        $fdomaines=f_domaine::all();

        return view('livewire.project-section.fournisseurs-list',['fournisseurs'=>$fournisseurs,'f_domaines'=>$fdomaines]);
    }





//   validation real -time
    public function updated($fields){
        $this->validateOnly($fields,[
            'name'=>'required',
            'id_fdomaine'=>'required|integer',
            'ice'=>'required|integer',
            'phone'=>'required|integer',
            'email'=>'required|email',
            'adress'=>'required',
        ]);
    }

    // save projects start
    public function saveData(){
        $this->validate([
            'name'=>'required',
            'id_fdomaine'=>'required|integer',
            'ice'=>'required|integer',
            'phone'=>'required|integer',
            'email'=>'required|email',
            'adress'=>'required',

        ]);


        $fournisseur = new Fournisseur;
        $fournisseur->name = $this->name;
        $fournisseur->id_fdomaine = $this->id_fdomaine;
        $fournisseur->ice = $this->ice;
        $fournisseur->phone  = $this->phone ;
        $fournisseur->email  = $this->email ;
        $fournisseur->adress = $this->adress;

        $fournisseur->save();
        session()->flash('message','Fournisseur bien ajouter');

        // for empty input fields after validation

        $this->resetInputs();

        $this->dispatchBrowserEvent('add');

        // for hidden the model
        $this->dispatchBrowserEvent('close-model');


    }
// save project end

// reset inputs of fournisseur
private function resetInputs(){
        $this->name = "";
        $this->id_fdomaine = "";
        $this->ice = "";
        $this->phone = "" ;
        $this->email  = "";
        $this->adress = "";

}

// edit Fournisseur
public function editFournisseur($id){
    $fournisseur = Fournisseur::where('id',$id)->first();
    $this->id_fournisseur = $fournisseur->id;
    $this->id_fdomaine = $fournisseur->id_fdomaine;
    $this->name= $fournisseur->name;
    $this->ice = $fournisseur->ice;
    $this->phone = $fournisseur->phone;
    $this->email = $fournisseur->email;
    $this->adress = $fournisseur->adress;

}

public function editData(){
    $fournisseur = Fournisseur::where('id',$this->id_fournisseur)->first();
    $fournisseur = new Fournisseur;
    $fournisseur->id_fdomaine = $this->id_fdomaine;
    $fournisseur->name = $this->name;
    $fournisseur->ice  = $this->ice ;
    $fournisseur->phone  = $this->phone ;
    $fournisseur->email = $this->email;
    $fournisseur->adress = $this->adress;

    $fournisseur->save();
    session()->flash('message','Fournisseur bien modifer');
    $this->dispatchBrowserEvent('close-model');
}

//  delete fournisseur start

public function deleteFournisseur($id){
    $fournisseur = Fournisseur::where('id',$id)->first();
    $this->id_fournisseur = $id;
    $this->id_fdomaine = $fournisseur->id_fdomaine;
    $this->name= $fournisseur->name;
    $this->ice = $fournisseur->ice;
    $this->phone = $fournisseur->phone;
    $this->email = $fournisseur->email;
    $this->adress = $fournisseur->adress;
}

public function deleteData(){
    $fournisseur = Fournisseur::where('id',$this->id_fournisseur)->first();
    $fournisseur->delete();
    session()->flash('message','Foiurnisseur bien supprimer');
    $this->dispatchBrowserEvent('add');
    $this->dispatchBrowserEvent('close-model');

}
//  delete project end


// delete multiple projects start


public function  deleteSelected(){
     Fournisseur::query()
    ->whereIn('id',$this->selectedfournisseur)
    ->delete();

     $this->selectedfournisseur = [];
   $this->selectAll = false;

}


public function updatedSelectAll($value){
if($value){
    $this->selectedfournisseur = Fournisseur::pluck('id');
}else{
    $this->selectedfournisseur = [];
}
}

// delete multiple projects end




// import project start

 public function importData(){
    $this->validate([

        'excelFile'=>'required|mimes:xlsx,xls',
    ]);




    // $path = file_get_contents($tt);

        $path= $this->exelFile->store('','app');
        Excel::import(new ProjetsImport($this->exelFile,$path),$path);
        session()->flash('message','projet bien imposter');


 }
 //import project end

//  validate function
public function validationdata(){

}















}
