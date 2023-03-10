<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_project',
        'type',
        'situation',
        'prix',
        'image',
        'etage',
        'numero_bien',
        
    ];
}
