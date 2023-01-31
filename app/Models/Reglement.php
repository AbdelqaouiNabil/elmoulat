<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reglement extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'methode',
        'montant',
        'numero_cheque',
        'id_transaction',
        'id_facture',
        'id_contrat',
       

       
        
    ];
}
