<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contart extends Model
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
