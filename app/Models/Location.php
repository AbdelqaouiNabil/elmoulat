<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_bien',
        'id_client',
        'contrat_pdf',
        'datedebut',
        'datefin',
        'montant',
        'avance',
        
    ];

    public function bien(){
        return $this->belongsTo(Bien::class,'id_bien');
    }
    public function client(){
        return $this->belongsTo(Client::class,'id_client');
    }
}
