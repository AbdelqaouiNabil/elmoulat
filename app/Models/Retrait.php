<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retrait extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_caisse',
        'operation_ref',
        'id_reglement',
        'montant',
        'date',
        'id_depense',

        
      
        
    ];
}
