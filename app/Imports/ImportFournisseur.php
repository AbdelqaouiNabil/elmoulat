<?php

namespace App\Imports;

use App\Models\Fournisseur;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportFournisseur implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Fournisseur([
            //
        ]);
    }
}
