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
       'bonpdf',
       'date',
       'montant',
       'situation',
   ];


    public function projet(){
    return $this->belongsTo(Projet::class, 'id_projet');
   }
    public function reglement(){
        return $this->belongsTo(Reglement::class, 'id_reglement');
    }

    public function fournisseur(){
    return $this->belongsTo(Fournisseur::class, 'fournisseur_id');
   }



}
