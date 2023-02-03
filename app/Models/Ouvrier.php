<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ouvrier extends Model
{
    use HasFactory;
      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'nom',
        'datenais',
        'cin',
        'n_cin',
        'datedubet',
        'observation',
        'notation',
        'phone',
        'email',
        'adress',
        'contrat',
        


    ];
}
