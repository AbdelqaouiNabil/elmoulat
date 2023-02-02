<?php

namespace App\Http\Livewire\ProjectSection;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Ouvrier;
use App\Imports\ImportOuvrier;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use File;


class OuvriersList extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $nom,$datenais,$cin,$n_cin,$datedubet,$observation,$notation,$email,$adress,$phone,$id_ouvrier,$excelFile;

    public $checked_id=[];
    public $selectAll=false;
    public $btndelete=true;
    public $sortname="id";
    public $sortdrection="DESC";
    public $pages = 5;
    protected $listeners = ['saveData' => 'saveData'];

   

    public function render()
    {
        $this->btndelete=count($this->checked_id)<1;
        $ouvriers=Ouvrier::orderBy($this->sortname,$this->sortdrection)->paginate($this->pages,['*'],'new');
        return view('livewire.project-section.ouvriers-list',['ouvriers'=>$ouvriers]);
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
       
        $validatedata=$this->validate([
           'nom'=>'required',
           'datenais'=>'required|date',
           'cin'=>'mimes:pdf',
           'n_cin'=>'required',
           'datedubet'=>'required|date',
           'observation'=>'required',
           'notation'=>'required|integer',
           'phone'=>'required|integer',
           
        ]);

        $cinfile=$this->cin->store('Documents/ouvrier','public');
        

        $ouvrier=new Ouvrier();
        $ouvrier->nom=$this->nom;
        $ouvrier->datenais=$this->datenais;
        $ouvrier->cin=$cinfile;
        $ouvrier->n_cin=$this->n_cin;
        $ouvrier->datedubet=$this->datedubet;
        $ouvrier->observation=$this->observation;
        $ouvrier->notation=$this->notation;
        $ouvrier->phone=$this->phone;
        $ouvrier->email=$this->email;
        $ouvrier->adress=$this->adress;
        
        $ouvrier->save();

        $this->resetInputs();
        session()->flash('message','Ouvrier bien ajouter');
        $this->dispatchBrowserEvent('add');

        // for hidden the model
        $this->dispatchBrowserEvent('close-model');
        


    }

    private function resetInputs(){

        $this->nom="";
        $this->datenais="";
        $this->cin="";
        $this->n_cin="";
        $this->datedubet="";
        $this->observation="";
        $this->notation="";
        $this->email="";
        $this->phone="";
        $this->adress="";
      

    }

    // validator function
    //   validation real -time
    public function updated($fields){
        $this->validateOnly($fields,[
            'nom'=>'required',
            'datenais'=>'required|date',
            'cin'=>'mimes:pdf',
            'n_cin'=>'required',
            'datedubet'=>'required|date',
            'observation'=>'required',
            'notation'=>'required|integer',
            'phone'=>'required|integer',
        ]);
    }



// delete ouvrier

    public function deleteOuvrier($id){
       
        $ouvrier = Ouvrier::where('id',$id)->first();
        $this->id_ouvrier = $ouvrier->id;
        $this->nom= $ouvrier->nom;
        $this->datenais = $ouvrier->datenais;
        $this->cin = $ouvrier->cin;
        $this->n_cin = $ouvrier->n_cin;
        $this->datedubet = $ouvrier->datedubet;
        $this->observation = $ouvrier->obseravtion ;
        $this->notation = $ouvrier->notation ;
        $this->phone= $ouvrier->phone;
        $this->email=$ouvrier->email;
        $this->adress=$ouvrier->adress;
    
    }

    public function deleteData(){
        $path=Storage::disk('local')->url($this->cin);
        File::delete(public_path($path));
        //unlink(storage_path($path));
        $ouvrier = Ouvrier::where('id',$this->id_ouvrier)->first();
        $ouvrier->delete();
        session()->flash('message','ouvrier bien supprimer ');
        $this->dispatchBrowserEvent('add');
        // for hidden the model
        $this->dispatchBrowserEvent('close-model');
    }


    
   //edit ouvrier=====================

    public function editOuvrier($id){
        $ouvrier = Ouvrier::where('id',$id)->first();
        $this->id_ouvrier = $id;
        
        $this->nom= $ouvrier->nom;
        $this->datenais = $ouvrier->datenais;
        $this->cin = $ouvrier->cin;
        $this->n_cin = $ouvrier->n_cin;
        $this->datedubet = $ouvrier->datedubet;
        $this->observation = $ouvrier->observation ;
        $this->notation = $ouvrier->notation ;
        $this->phone= $ouvrier->phone;
        $this->email=$ouvrier->email;
        $this->adress=$ouvrier->adress;
        

       
        
    }

    public function editData(){
        $validatedata=$this->validate([
            'nom'=>'required',
            'datenais'=>'required|date',
            'cin'=>'mimes:pdf',
            'n_cin'=>'required',
            'datedubet'=>'required|date',
            'observation'=>'required',
            'notation'=>'required|integer',
            'phone'=>'required|integer',
            
         ]);

        $ouvrier = Ouvrier::where('id',$this->id_ouvrier)->first();
        $ouvrier->nom=$this->nom;
        $ouvrier->datenais=$this->datenais;
        $ouvrier->n_cin=$this->n_cin;
        $ouvrier->datedubet=$this->datedubet;
        $ouvrier->observation=$this->observation;
        $ouvrier->notation=$this->notation;
        $ouvrier->phone=$this->phone;
        $ouvrier->email=$this->email;
        $ouvrier->adress=$this->adress;
        
        $ouvrier->save();
        $this->resetInputs();
        session()->flash('message','ouvrier bien modifer');
        $this->dispatchBrowserEvent('close-model');
    }


    // check all boxs

    public function deletecheckedouvrier(){

        Ouvrier::query()->whereIn('id',$this->checked_id)->delete();
        session()->flash('message','ouvriers bien supprimer');
        // pour vider les textboxs
        $this->checked_id=[];
        $this->btndelete=true;
        
    }
    public function updatedselectAll($value){
        if($value){
            $this->checked_id=Ouvrier::pluck('id');
        
        }
        else{
            $this->checked_id=[];
            $this->btndelete=true;
        }
    }
    // end of check all boxs



    //  import ouvrier 

    public function importData(){
        $this->validate([
           
            'excelFile'=>'required|mimes:xlsx,xls',
        ]);
        // $path= $this->exelFile->store('documents/OuvrierExcel','app');
        // $path = file_get_contents($path);
        Excel::import(new ImportOuvrier,$this->excelFile->store('Documents/ouvrier','app'));
        session()->flash('message','ouvriers bien importer');
        
     }
//  import project end



   



}
