<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Livewire\WithPagination;
use Livewire\WithFileUploads;


class ReleverBankaire extends Component
{

    use WithFileUpLoads;
    use WithPagination;

    public $id_Relever, $dateRelever;

    public $excelfile;
    public $pages = 10;
    public $bulkDisabled = true;
    public $selectedCharges = [];
    public $selectAll = false;
    protected $queryString  = ['search'];

    //transaction
    public $id_Trans, $date_Operation, $libelle, $debit, $credit, $date_Valeur, $typePayment;
    //Compte
    public $id_Compte, $numCompte;
    //Cheque
    public $id_cheque, $numCheque;



    public function render()
    {
        return view('livewire.relever-bankaire');
    }


    public function importData(){

    }
}
