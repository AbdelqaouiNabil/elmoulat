<?php

namespace App\Imports;

use App\Models\Ouvrier;
use Maatwebsite\Excel\Concerns\ToModel;

use Carbon\Carbon;

class ImportOuvrier implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        //$cinfile=$this->cin->store('Documents/ouvrier','public');
        return new Ouvrier([

            // str_replace("/","-","$row[1]")
            'nom'=>$row[0],
            'datenais'=> '2000-02-02',
            'cin'=>'',
            'n_cin'=>$row[3],
            'datedubet'=>'2000-02-02',
            'observation'=>$row[5],
            'notation'=>$row[6],
            'contrat'=>$row[7],
            //
        ]);
        // Carbon::createFromFormat('d/m/Y',$row[1])->format('Y-m-d')
    }
}
