<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;
    protected $fillable = [

        'titre',
        'datedebut',
        'datefin',
        'montant',
        'avance',
        'name_entreprise',
        'ice_entreprise',
        'id_ouvrier',
        'id_fournisseur',
        'id_projet'

    ];

    public function ouvrier(){
        return $this->belongsTo(Ouvrier::class, 'id_ouvrier');
    }
    public function projet(){
        return $this->belongsTo(Projet::class, 'id_projet');
    }
    public function fournisseur(){
        return $this->belongsTo(Fournisseur::class, 'id_fournisseur');
    }
}
