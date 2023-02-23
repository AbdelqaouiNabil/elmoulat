<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Caisse;

class Projet extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'image',
        'consistance',
        'titre_finance',
        'superfice',
        'adress',
        'ville',
        'autorisation',
        'datedebut',
        'datefin',
        'id_bureau',
        'id_caisse',
    ];
    public function caisse(){
        return $this->belongsTo(Caisse::class,'id_caisse');
    }
    public function bureau(){
        return $this->belongsTo(Bureau::class,'id_bureau');
    }
    public function charge(){
        return $this->hasMany(Charge::class, 'id_projet');
    }
}
