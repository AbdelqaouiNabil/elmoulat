<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chequier extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'dateDeMiseEnDisposition',
        'numeroDeDebut',
        'numeroDeFin',
        'nombreDeCheque',
        'id_compte',
       
       
    ];
    public function compte($id){
        return $this->hasOne(Compte::class,$id);
    }
}
