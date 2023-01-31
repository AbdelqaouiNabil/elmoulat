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
    public function compte(){
        return $this->belongsTo(Compte::class,'id_compte');
    }

    public function cheque(){
        return $this->hasMany(Cheque::class , 'id_chequier');
    }

    // this is a recommended way to declare event handlers
    public static function boot() {
        parent::boot();

        static::deleting(function($chequier) { // before delete() method call this
             $chequier->cheque()->delete();
             // do the rest of the cleanup...
        });
    }
}
