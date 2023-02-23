<?php
namespace App\Imports;

use App\Models\Bureau;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class releverBancaireImport implements ToModel
{

     /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {
        // return new Bureau([
        //    'nom'     => $row[0],
        //    'ville'    => $row[1],
        //    'phone' => $row[2],
        // ]);
    }



}
