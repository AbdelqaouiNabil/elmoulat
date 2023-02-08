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
   
    public function collection()
    {
        $projects = Projet::all();
  
        foreach($projects as $project){

            $project->id_bureau = $project->bureau->nom;
            $project->id_caisse = $project->caisse->name;
        }
        
        return $projects;


    }
    public function headings(): array
    {
        return ["id", "name","superfice","consistance","titre finance","autorisation","adress","ville","date debut","date fin","bureau","caisse"];
    }
}
