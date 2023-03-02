<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_cheque',
        'id_releverbancaire',
        'date_Operation',
        'date_Valeur',
        'typeCheck',
        'libelle',
        'credit',
        'debit'

    ];

    
}
