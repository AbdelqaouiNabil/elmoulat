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
<<<<<<< HEAD
    public function caisse(){
        return $this->hasOne(Caisse::class);
    }
    public function bureau(){
        return $this->hasOne(Bureau::class);
=======

    public function charge(){
        return $this->hasMany('App\Models\Charge');
>>>>>>> 094867f4b70fcf0e91f96be9e9f938dbb0ee6a0f
    }
}
