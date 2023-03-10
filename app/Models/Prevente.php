<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prevente extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_bien',
        'id_client',
        'contrat_pdf',
        'datedebut',
        'datefin',
        'montant',
        'avance',
        
    ];
}
