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

       'fournisseur_id',
       'id_projet',
       'id_reglement',
       'name',
       'type',
       'bon',
       'prix_ht',
       'tva',
       'QT',
       'prix_TTC',
       'MTTTC',
       'situation',
   ];


    public function projet(){
    return $this->belongsTo('App\Models\Projet', 'id_projet');
   }
    public function reglement(){
        return $this->belongsTo('App\Models\Reglement', 'id_reglement');
    }

    public function fournisseur(){
    return $this->belongsTo('App\Models\Fournisseur', 'fournisseur_id');
   }



}
