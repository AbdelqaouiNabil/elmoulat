<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'name',
        'datedubet',
        'datefin',
        'montant',
        'avance',
        'id_ouvrier'
       
    ];
}
