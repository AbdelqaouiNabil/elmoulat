<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Facture;
use App\Models\Contrat;
use App\Models\Charge;
use App\Models\Reglement;
use Exception;
use Livewire\WithPagination;
use Livewire\WithFileUploads;


class ReglementsList extends Component
{
    use WithFileUpLoads;
    use WithPagination;

    public $id_reg, $methode, $montant, $date, $numero_cheque, $id_facture, $id_contrat, $nom_contrat, $num_facture, $optionCheque;
    public $selectedRegs = [];
    public $pages = 10;
    public $bulkDisabled = true;
    public $selectAll = false;

    public function updatedPages()
    {
        $this->resetPage('new');
    }


    //  public $numberOfPaginatorsRendered = [];
    public function render()
    {
        $this->bulkDisabled = count($this->selectedRegs) < 1;
        $reglements = Reglement::latest()->paginate($this->pages, ['*'], 'new');
        $factures = Facture::all();
        return view('livewire.reglements-list', ["reglements" => $reglements, "factures" => $factures]);
    }


    public function showReglement($id)
    {
        $reg = Reglement::where('id', $id)->first();
        $this->methode = $reg->methode;
        $this->montant = $reg->montant;
        $this->date = $reg->date;
        if (!is_null($reg->id_facture)) {
            $facture = Facture::where('id', $reg->id_facture)->first();
            $this->num_facture = $facture->numero;
        }
        if (!is_null($reg->id_contrat)) {
            $contrat = Contrat::where('id', $reg->id_contrat)->first();
            $this->nom_contrat = $contrat->name;
        }
    }




    // method cheque ou non cheque
    public $optionC = false;
    public function optionCheque()
    {
        if ($this->optionC) {
            $this->optionC = false;
        } else {
            $this->optionC = true;
        }
    }









    public function editReglement($id)
    {
        $reglement = Reglement::where('id', $id)->first();
        $this->id_reg = $reglement->id;
        $this->date = $reglement->date;
        $this->montant = $reglement->montant;
        $this->methode = $reglement->methode;
        $this->numero_cheque = $reglement->numero_cheque;
        if (!is_null($reglement->id_facture)) {
            $facture = Facture::where('id', $reglement->id_facture)->first();
            $this->num_facture = $facture->numero;
        }
        if (!is_null($reglement->id_contrat)) {
            $contrat = Contrat::where('id', $reglement->id_contrat)->first();
            $this->nom_contrat = $contrat->name;
        }

    }

    public function updateReglement()
    {
        if (!is_null($this->num_facture)) {
            $facture = Facture::where('numero', $this->num_facture)->first();
            $this->id_facture = $facture->id;
        }
        if (!is_null($this->nom_contrat)) {
            $contrat = Contrat::where('name', $this->nom_contrat)->first();
            $this->id_contrat = $contrat->id;
        }
        if ($this->optionC) {
            $this->methode = 'cheque';
        } else {
            $this->methode = 'cash';
        }
        $reglement = reglement::where('id', $this->id_reg)->first();
        $reglement->date = $this->date;
        $reglement->methode  = $this->methode;
        $reglement->montant = $this->montant;
        $reglement->numero_cheque = $this->numero_cheque;
        $reglement->id_facture = $this->id_facture;
        $reglement->id_contrat = $this->id_contrat;
        $reglement->save();
        session()->flash('message', 'reglement bien modifer');
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-model');
    }

    public function deleteReglement($id)
    {
        $this->id_reg = $id;
    }

    public function deleteData()
    {
        $this->updateChargeReg($this->id_reg);
        Reglement::findOrFail($this->id_reg)->delete();
        session()->flash('message', 'reglement deleted successfully');
        $this->dispatchBrowserEvent('close-model');
    }

    public function deleteSelected()
    {
        for($j = 0; $j<count($this->selectedRegs); $j++){
            $charge = Charge::where('id_reglement', $this->selectedRegs[$j])->get();
            for($i = 0; $i<count($charge); $i++){
                $charge[$i]->situation = "notPayed";
                $charge[$i]->id_reglement = null;
                $charge[$i]->save();
            }
        }
        reglement::query()
            ->whereIn('id', $this->selectedRegs)
            ->delete();

        $this->selectedRegs = [];
        $this->selectAll = false;
    }

    // update the charges table after deleting the reglement
    public function updateChargeReg($idR){
        $charge = Charge::where('id_reglement', $idR)->get();
        for($i = 0; $i<count($charge); $i++){
            $charge[$i]->situation = "notPayed";
            $charge[$i]->id_reglement = null;
            $charge[$i]->save();
        }
    }











    public function saveReglement()
    {
        if (!is_null($this->num_facture)) {
            $facture = Facture::where('numero', $this->num_facture)->first();
            $this->id_facture = $facture->id;
        }
        if (!is_null($this->nom_contrat)) {
            $contrat = Contrat::where('name', $this->nom_contrat)->first();
            $this->id_contrat = $contrat->id;
        }
        if ($this->optionC) {
            $this->methode = 'cheque';
        } else {
            $this->methode = 'cash';
        }
        reglement::create([
            'date' => $this->date,
            'montant' => $this->montant,
            'methode' => $this->methode,
            'numero_cheque' => $this->numero_cheque,
            'id_facture' => $this->id_facture,
            'id_contrat' => $this->id_contrat,
        ]);
        session()->flash('message', 'reglement created successfully');
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-model');
    }

    public function resetInputs()
    {
        $this->methode = "";
        $this->montant  = "";
        $this->numero_cheque = "";
        $this->num_facture = "";
        $this->id_contrat = "";
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedRegs = Reglement::pluck('id');
        } else {
            $this->selectedRegs = [];
        }
    }
}
