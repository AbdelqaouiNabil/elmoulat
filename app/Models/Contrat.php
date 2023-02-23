<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;
    protected $fillable = [

        'name',
        'datedebut',
        'datefin',
        'montant',
        'avance',
        'id_ouvrier',
        'cin_Ouv',
        'id_projet'

    ];

    public function ouvrier(){
        return $this->belongsTo('App\Models\Ouvrier', 'id_ouvrier');
    }
    public function projet(){
        return $this->belongsTo('App\Models\Projet', 'id_projet');
    }
}
