<?php

namespace App\Exports;

use DB;

use App\Models\Projet;
use App\Models\Bureau;
use App\Models\Caisse;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;

class ProjectExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $selectRows;
    function __construct(array $selectProjectRows){
        $this->selectRows=$selectProjectRows;
    }
    public function collection()
    {
        $data=array();
        $projects = Projet::whereIn('id',$this->selectRows)->get();
        foreach($projects as $project){
            $project->id_bureau = $project->bureau->nom;
            $project->id_caisse = $project->caisse->name;
        }
        return $projects;
    }
    public function headings(): array
    {
        return ["id", "name","image","superfice","consistance","titre finance","autorisation","adress","ville","date debut","date fin","bureau","caisse"];
    }
}
