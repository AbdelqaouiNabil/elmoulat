<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garantie extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_project',
        'id_vente',
        'datedebut',
        'datefin',

    ];
}
