<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avance extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'date',
        'montant',
        'id_retrait',
        'id_contrat',
        'ref_virement',
        'ref_med',
        'numero_cheque',
        
    ];
}
