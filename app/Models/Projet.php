<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function charge(){
        return $this->hasMany('App\Models\Charge');
    }
}
