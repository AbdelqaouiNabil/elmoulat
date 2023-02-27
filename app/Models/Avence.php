<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avence extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'dateA',
        'montant',
        'id_client',
        'id_vente',
        
    ];

    public function client(){
        return $this->belongsTo(Client::class,'id_client');
    }
    public function vente(){
        return $this->belongsTo(Vente::class,'id_vente');
    }
}
