<?php

namespace App\Http\Livewire\ProjectSection;

use Illuminate\Database\QueryException;
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

    public $nom,$datenais,$cin,$n_cin,$datedebut,$observation,$notation,$email,$adress,$phone,$id_ouvrier,$excelFile;

    public $checked_id=[];
    public $selectAll=false;
    public $btndelete=true;
    public $sortname="id";
    public $sortdrection="DESC";
    public $pages = 5;
    public $search;
    protected $listeners = ['saveData' => 'saveData'];

   

    public function render()
    {
        $this->btndelete=count($this->checked_id)<1;
        $ouvriers=Ouvrier::where('nom', 'like', '%'.$this->search.'%')
        ->orWhere('n_cin', 'like', '%'.$this->search.'%')
        ->orderBy($this->sortname, $this->sortdrection)->paginate($this->pages, ['*'], 'new');
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
           'datedebut'=>'required|date',
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
        $ouvrier->datedebut=$this->datedebut;
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
        $this->datedebut="";
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
            'datedebut'=>'required|date',
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
        $this->datedebut = $ouvrier->datedebut;
        $this->observation = $ouvrier->observation ;
        $this->notation = $ouvrier->notation ;
        $this->phone= $ouvrier->phone;
        $this->email=$ouvrier->email;
        $this->adress=$ouvrier->adress;
    
    }

    public function deleteData(){
        $path=Storage::disk('local')->url($this->cin);
        File::delete(public_path($path));
        $ouvrier = Ouvrier::where('id',$this->id_ouvrier)->first();
        $ouvrier->delete();
        session()->flash('message','ouvrier bien supprimer ');
        $this->dispatchBrowserEvent('add');
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
        $this->datedebut = $ouvrier->datedebut;
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
            'n_cin'=>'required',
            'datedebut'=>'required|date',
            'observation'=>'required',
            'notation'=>'required|integer',
            'phone'=>'required|integer',
            
         ]);

        $ouvrier = Ouvrier::where('id',$this->id_ouvrier)->first();
        $ouvrier->nom=$this->nom;
        $ouvrier->datenais=$this->datenais;
        $ouvrier->n_cin=$this->n_cin;
        $ouvrier->datedebut=$this->datedebut;
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
        $id = [];
        $deleted = [];
        $ouvriers = Ouvrier::query()->whereIn('id', $this->checked_id)->get();
        foreach ($ouvriers as $ouvrier) {
            try {
                $ouvrier = Ouvrier::where('id', $ouvrier->id)->first();
                $ouvrier->delete();
                $path = Storage::disk('local')->url($ouvrier->cin);
                File::delete(public_path($path));
                $deleted[] = $ouvrier->id;
            } catch (QueryException $ex) {
                $id[] = $ouvrier->id;
            }
        }
        if (count($deleted) > 0) {
            session()->flash('message', "Deleted seccesfully Ouvriers of Id=[" . implode(",", $deleted) . "]");
        }
        if(count($id)>0){
            session()->flash('error', "Can't delete Ouvriers of Id=[" . implode(",", $id) . "] Because is Used as ForeignKey ");
        }
        $this->checked_id = $id;
        $this->selectAll = false;
        $id = [];
        $deleted = [];
        
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
