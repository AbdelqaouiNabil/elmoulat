<?php

namespace App\Http\Livewire\ProjectSection;

use App\Models\Facture;
use Illuminate\Database\QueryException;
use Livewire\Component;
use App\Models\f_domaine;
use App\Models\Charge;
use App\Models\Fournisseur;
use Livewire\WithFileUploads;
use Livewire\WithPagination;


class FournisseursList extends Component
{


    use WithFileUploads;
    use WithPagination;

    public $name, $ice, $phone, $email, $adress, $id_fournisseur, $id_fdomaine, $sorttype,$search;
    public $excelFile;
    public $selectedfournisseur = [];
    public $selectAll = false;
    public $bulkDisabled = true;
    public $pages = 5;
    protected $listeners = ['saveData' => 'saveData'];
    public $sortname = "id";
    public $sortdrection = "DESC";

    public function updatingPages($value)
    {
        $this->resetPage('new');

    }

    public function render()
    {
        $this->bulkDisabled = count($this->selectedfournisseur) < 1;

        if ($this->sorttype != "" && $this->sorttype != "id") {
            $fournisseurs = Fournisseur::where('id_fdomaine', $this->sorttype)->paginate($this->pages, ['*'], 'new');


        } elseif ($this->sorttype == "id") {
            $fournisseurs = Fournisseur::where('name', 'like', '%'.$this->search.'%')
            ->orWhere('ice', 'like', '%'.$this->search.'%')
            ->orderBy($this->sortname, $this->sortdrection)->paginate($this->pages, ['*'], 'new');

        } else {
            $fournisseurs = Fournisseur::where('name', 'like', '%'.$this->search.'%')
            ->orWhere('ice', 'like', '%'.$this->search.'%')
            ->orderBy($this->sortname, $this->sortdrection)->paginate($this->pages, ['*'], 'new');

        }
        $fdomaines = f_domaine::all();

        return view('livewire.project-section.fournisseurs-list', ['fournisseurs' => $fournisseurs, 'f_domaines' => $fdomaines]);
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





    //   validation real -time
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'id_fdomaine' => 'required|integer',
            'ice' => 'required|integer|min:14',
            'phone' => 'required|integer',
            'email' => 'required|email',
            'adress' => 'required',
        ]);
    }

    // save projects start
    public function saveData()
    {
        $this->validate([
            'name' => 'required',
            'id_fdomaine' => 'required|integer',
            'ice' => 'required|integer|min:14',
            'phone' => 'required|integer',
            'email' => 'required|email',
            'adress' => 'required',

        ]);


        $fournisseur = new Fournisseur;
        $fournisseur->name = $this->name;
        $fournisseur->id_fdomaine = $this->id_fdomaine;
        $fournisseur->ice = $this->ice;
        $fournisseur->phone = $this->phone;
        $fournisseur->email = $this->email;
        $fournisseur->adress = $this->adress;

        $fournisseur->save();
        session()->flash('message', 'Fournisseur bien ajouter');

        // for empty input fields after validation

        $this->resetInputs();

        $this->dispatchBrowserEvent('add');

        // for hidden the model
        $this->dispatchBrowserEvent('close-model');


    }
    // save project end

    // reset inputs of fournisseur
    private function resetInputs()
    {
        $this->name = "";
        $this->id_fdomaine = "";
        $this->ice = "";
        $this->phone = "";
        $this->email = "";
        $this->adress = "";

    }

    // edit Fournisseur
    public function editFournisseur($id)
    {
        $fournisseur = Fournisseur::where('id', $id)->first();
        $this->id_fournisseur = $fournisseur->id;
        $this->id_fdomaine = $fournisseur->id_fdomaine;
        $this->name = $fournisseur->name;
        $this->ice = $fournisseur->ice;
        $this->phone = $fournisseur->phone;
        $this->email = $fournisseur->email;
        $this->adress = $fournisseur->adress;


    }

    public function editData()
    {
        $this->validate([
            'name' => 'required',
            'id_fdomaine' => 'required|integer',
            'ice' => 'required|integer|min:14',
            'phone' => 'required|integer',
            'email' => 'required|email',
            'adress' => 'required',

        ]);
        $fournisseur = Fournisseur::where('id', $this->id_fournisseur)->first();
        $fournisseur->id_fdomaine = $this->id_fdomaine;
        $fournisseur->name = $this->name;
        $fournisseur->ice = $this->ice;
        $fournisseur->phone = $this->phone;
        $fournisseur->email = $this->email;
        $fournisseur->adress = $this->adress;
        $fournisseur->save();
        session()->flash('message', 'Fournisseur bien modifer');
        $this->dispatchBrowserEvent('close-model');
    }

    //  delete fournisseur start

    public function deleteFournisseur($id)
    {
        $fournisseur = Fournisseur::where('id', $id)->first();
        $this->id_fournisseur = $id;
        $this->id_fdomaine = $fournisseur->id_fdomaine;
        $this->name = $fournisseur->name;
        $this->ice = $fournisseur->ice;
        $this->phone = $fournisseur->phone;
        $this->email = $fournisseur->email;
        $this->adress = $fournisseur->adress;
    }

    public function deleteData()
    {
        
        $check= Charge::where('fournisseur_id',$this->id_fournisseur)->first();
        $check2= Facture::where('fournisseur_id',$this->id_fournisseur)->first();
        if($check || $check2){
            session()->flash('error','You selected an fournisseur aready used in charge table as ForingKey');
            return;
            
        }else {
            $fournisseur = Fournisseur::where('id', $this->id_fournisseur)->first();
            $fournisseur->delete();
            session()->flash('message', 'les fournisseur bien supprimer');
            $this->resetInputs();
            $this->dispatchBrowserEvent('add');
        }

    }
    //  delete project end


    // delete multiple projects start


    public function deleteSelected()
    {
        foreach ($this->selectedfournisseur as $r) {
        $check2= Facture::where('fournisseur_id',$this->id_fournisseur)->first();
        $check = Charge::where('fournisseur_id', $r)->first();
            if ($check || $check2) {
                session()->flash('error', 'You selected an fournisseur aready used in charge table as ForingKey');
                return;

            } else {
                $fournisseur = Fournisseur::where('id', $r)->first();
                $fournisseur->delete();
                session()->flash('message', 'les fournisseur bien supprimer');
                $this->resetInputs();
                $this->dispatchBrowserEvent('add');
            }
        }

    }


    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedfournisseur = Fournisseur::pluck('id');
        } else {
            $this->selectedfournisseur = [];
        }
    }

    // delete multiple projects end




    // import project start

    public function importData()
    {
        $this->validate([

            'excelFile' => 'required|mimes:xlsx,xls',
        ]);

        // $path = file_get_contents($tt);

        $path = $this->exelFile->store('', 'app');
        Excel::import(new ProjetsImport($this->exelFile, $path), $path);
        session()->flash('message', 'projet bien imposter');


    }
    //import project end

    //  validate function 
    public function validationdata()
    {

        
    }















}