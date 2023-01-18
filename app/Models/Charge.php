<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    use HasFactory;
    use HasFactory;
    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
   protected $fillable = [
       
       'fornisseur_id',
       'projet_id',
       'ouvrier_id',
       'Reglement_id',
       'facture_id',
       'name',
       'type',
       'bon',
       'prix',
       'Tva',
       'QT',
       'prix_TTC',
       'MTTTC',
       'situation',
   ];
}