<?php

namespace App\Http\Livewire;

use App\Models\Caisse;
use App\Models\Retrait;
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
    public $numero, $date, $scan_pdf, $id_facture, $fournisseur_id, $type, $search, $montant, $prix, $caisse;
    public $selectRows = [];
    public $selectAll = false;
    public $bulkDisabled = true;
    public $pages = 5;
    public $sortname = "id";
    public $sortdrection = "DESC";

    public function render()
    {
        $caisses = Caisse::all();
        $this->bulkDisabled = count($this->selectRows) < 1;
        $factures = Facture::where('numero', 'like', '%' . $this->search . '%')
            ->orWhere('type', 'like', '%' . $this->search . '%')->orderBy($this->sortname, $this->sortdrection)->paginate($this->pages, ['*'], 'new');
        $fournisseurs = Fournisseur::all();
        return view('livewire.facture-list', ['factures' => $factures, 'fournisseurs' => $fournisseurs, 'caisses' => $caisses]);
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
            'numero' => 'required|regex:/[0-9]*/',
            'montant' => 'required|regex:/^\d*(\.\d{2})?$/',
            'prix' => 'regex:/^\d*(\.\d{2})?$/',
            'scan_pdf' => 'required|mimes:pdf',
            'type' => 'required',
            'date' => 'required|date',
            'fournisseur_id' => 'required|integer',
            'caisse' => 'integer',

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
        $this->montant = "";
        $this->prix = "";

    }


    //save data function
    public function saveData()
    {
        $this->validate([

            'numero' => 'required|regex:/[0-9]*/',
            'scan_pdf' => 'required|mimes:pdf',
            'type' => 'required',
            'date' => 'required|date',
            'fournisseur_id' => 'required|integer',
            'montant' => 'required|regex:/^\d*(\.\d{2})?$/',
           
        ]);
        if($this->type!='real'){
            $this->validate([
                'prix' => 'required|regex:/^\d*(\.\d{2})?$/',
                'caisse' => 'required|integer',

            ]);
        }


        $scanfile = $this->scan_pdf->store('Documents/Facture', 'public');
        $facture = new Facture;
        $facture->numero = $this->numero;
        $facture->date = $this->date;
        $facture->type = $this->type;
        $facture->montant = $this->montant;
        $facture->fournisseur_id = $this->fournisseur_id;
        $facture->scan_pdf = $scanfile;
        $valide = $facture->save();
        

        if ($valide && ($this->type == 'fake' || $this->type == 'ajustement')) {
           
            $retrait = new Retrait();
            $retrait->montant = $this->prix;
            $retrait->id_caisse = $this->caisse;
            $retrait->id_facture = $facture->id;
            $retrait->date = date("Y/m/d");
            $valide = $retrait->save();
            if ($valide) {
                $caisse = Caisse::where('id', $this->caisse)->first();
                $caisse->sold = $caisse->sold - $retrait->montant;
                $caisse->update();
            }
            session()->flash('message', 'facture bien ajouter');
            // for empty input fields after validation
            $this->resetInputs();
            // for hidden the model
            $this->dispatchBrowserEvent('add');
            $this->dispatchBrowserEvent('close-model');

        }
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
        $this->montant = $facture->montant;
        $this->fournisseur_id = $facture->fournisseur_id;
        if($this->type == 'fake' || $this->type == 'ajustement'){
         $retrait = Retrait::where('id_facture', $id)->first();
         $this->prix = $retrait->montant;
         $this->caisse = $retrait->id_caisse;
        }

    }

    public function editData()
    {
        $this->validate([
            'numero' => 'required|regex:/[0-9]*/',
            'type' => 'required',
            'date' => 'required|date',
            'fournisseur_id' => 'required|integer',
            'montant' => 'required|regex:/^\d*(\.\d{2})?$/',
        ]);
        if($this->type !='real'){
            $this->validate([
                'prix' => 'required|regex:/^\d*(\.\d{2})?$/',
                'caisse' => 'required|integer',

            ]);
        }
        $facture = Facture::where('id', $this->id_facture)->first();
        $facture->numero = $this->numero;
        $facture->date = $this->date;
        $facture->type = $this->type;
        $facture->montant = $this->montant;
        $facture->fournisseur_id = $this->fournisseur_id;
        $valide = $facture->update();
        if ($valide && ($this->type == 'fake' || $this->type == 'ajustement')) {
            
            $retrait = Retrait::where('id_facture', $this->id_facture)->first();
            $retrait->montant = $this->prix;
            $retrait->id_caisse = $this->caisse;
            $valide = $retrait->update();
            if ($valide) {
                $caisse = Caisse::where('id', $this->caisse)->first();
                $caisse->sold = $caisse->sold - $retrait->montant;
                $caisse->update();
            }
        }
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
        $reglement = Reglement::where('id_facture', $this->id_facture)->get();
        $retrait = Retrait::where('id_facture', $this->id_facture)->get();
        if (count($reglement) > 0 || count($retrait) > 0) {
            session()->flash('error', ' facture used  as ForingKey');

        } else {
            $facture = Facture::where('id', $this->id_facture)->first();
            $facture->delete();
            $path = Storage::disk('local')->url($facture->scan_pdf);
            File::delete(public_path($path));
            session()->flash('message', 'facture bien supprimer');
        }

        $this->dispatchBrowserEvent('close-model');
        $this->resetInputs();


    }

    // delete selected rows on the table 
    public function deleteSelectedRows()
    {
        $reglement = Reglement::whereIn('id_facture', $this->selectRows)->get();
        $retrait = Retrait::whereIn('id_facture', $this->selectRows)->get();
        if (count($reglement) > 0 || count($retrait) > 0) {
            session()->flash('error', 'You selected a facture aready used as ForingKey');
        } else {
            $factures = Facture::whereIn('id', $this->selectRows)->get();
            foreach ($factures as $facture) {
                $path = Storage::disk('local')->url($facture->scan_pdf);
                File::delete(public_path($path));
                $facture->delete();
            }
            session()->flash('message','les facture bien supprimer');
        }
        $this->dispatchBrowserEvent('close-model');
        $this->resetInputs();


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