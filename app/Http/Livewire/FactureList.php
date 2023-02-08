<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Facture;
use App\Models\Fournisseur;
use App\Models\Reglement;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use File;

class FactureList extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $numero, $date, $scan_pdf, $id_facture,$fournisseur_id,$type, $search;
    public $selectRows = [];
    public $selectAll = false;
    public $bulkDisabled = true;
    public $pages = 5;
    public $sortname = "id";
    public $sortdrection = "DESC";

    public function render()
    {
        $this->bulkDisabled = count($this->selectRows) < 1;
        $factures = Facture::where('numero', 'like', '%'.$this->search.'%')
        ->orWhere('type', 'like', '%'.$this->search.'%')->orderBy($this->sortname, $this->sortdrection)->paginate($this->pages, ['*'], 'new');
        $fournisseurs = Fournisseur::all();
        return view('livewire.facture-list', ['factures' => $factures, 'fournisseurs' => $fournisseurs]);
    }

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

    // for paginate
    public function updatingPages($value)
    {
        $this->resetPage('new');

    }
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'numero' => 'required|integer',
            'scan_pdf' => 'required|mimes:pdf',
            'type' => 'required',
            'date' => 'required|date',
            'fournisseur_id' => 'required|integer',

        ]);
    }
    // this function for reset inputs
    public function resetInputs()
    {
        $this->numero = "";
        $this->date = "";
        $this->type = "";
        $this->scan_pdf = "";
        $this->id_facture = "";
        $this->fournisseur_id = "";

    }


    //save data function
    public function saveData()
    {
        $this->validate([

            'numero' => 'required|integer',
            'scan_pdf' => 'required|mimes:pdf',
            'type' => 'required',
            'date' => 'required|date',
            'fournisseur_id' => 'required|integer',


        ]);
        $scanfile=$this->scan_pdf->store('Documents/Facture','public');
        $facture = new Facture;
        $facture->numero = $this->numero;
        $facture->date = $this->date;
        $facture->type = $this->type;
        $facture->fournisseur_id = $this->fournisseur_id;
        $facture->scan_pdf = $scanfile;
        $facture->save();
        session()->flash('message', 'facture bien ajouter');

        // for empty input fields after validation

        $this->resetInputs();

        $this->dispatchBrowserEvent('add');

        // for hidden the model
        $this->dispatchBrowserEvent('close-model');


    }
    // edit data of a row 
    public function edit($id)
    {
        $facture = Facture::where('id', $id)->first();
        $this->id_facture = $id;
        $this->numero = $facture->numero;
        $this->date = $facture->date;
        $this->type = $facture->type;
        $this->scan_pdf = $facture->scan_pdf;
        $this->fournisseur_id = $facture->fournisseur_id;
    }

    public function editData()
    {
        
        $this->validate([

            'numero' => 'required|integer',
           
            'type' => 'required',
            'date' => 'required|date',
            'fournisseur_id' => 'required|integer',


        ]);
        $facture = Facture::where('id', $this->id_facture)->first();
        $facture->numero = $this->numero;
        $facture->date = $this->date;
        $facture->type = $this->type;
        $facture->fournisseur_id = $this->fournisseur_id;
        $facture->scan_pdf = $this->scan_pdf;
        $facture->save();
        $this->resetInputs();
        session()->flash('message', 'facture bien modifer');
        $this->dispatchBrowserEvent('close-model');
    }


    // delete data row 

    public function delete($id)
    {
        $facture = Facture::where('id', $id)->first();
        $this->id_facture = $id;
        $this->scan_pdf = $facture->scan_pdf;
        

    }

    public function deleteData()
    {
        $check = Reglement::where('id_facture', $this->id_facture)->first();
        if($check){
            session()->flash('error','le facture used  as ForingKey');
            
        }else {
            $facture = Facture::where('id', $this->id_facture)->first();
            $facture->delete();
            $path = Storage::disk('local')->url($facture->scan_pdf);
            File::delete(public_path($path));
            session()->flash('message', 'facture bien supprimer');
            $this->resetInputs();
            $this->dispatchBrowserEvent('add');
        }
        $this->resetInputs();


    }

    // delete selected rows on the table 
    public function deleteSelectedRows()
    {
        foreach ($this->selectRows as $r) {
            $check = Reglement::where('id_facture', $r)->first();
            if ($check) {
                session()->flash('error', 'You selected a facture aready used as ForingKey');
                return;

            } else {
                $facture = facture::where('id', $r)->first();
                $facture->delete();
                $path = Storage::disk('local')->url($facture->scan_pdf);
                File::delete(public_path($path));
                session()->flash('message', 'les factures bien supprimer');
                $this->resetInputs();
                $this->dispatchBrowserEvent('add');
            }
        }


    }


    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectRows = facture::pluck('id');
        } else {
            $this->selectRows = [];
        }
    }
}