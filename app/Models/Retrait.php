<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retrait extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_caisse',
        'id_reglement',
        'id_facture',
        'id_depense',
        'montant',
        'dateRet',
        'id_depense',
        'type_of_sold',
    ];
}
