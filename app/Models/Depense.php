<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    use HasFactory;
      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'id_projet',
        'id_ouvrier',
        'dateDep',
        'description',
        'Aqui',
        'type',
        'montant',

    ];

    public function projet(){
        return $this->belongsTo(Projet::class, 'id_projet');
    }

    public function ouvrier(){
        return $this->belongsTo(Ouvrier::class, 'id_ouvrier');
    }


}
