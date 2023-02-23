<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depot extends Model
{
    use HasFactory;
    protected $fillable = [

        'numero_cheque',
        'id_caisse',
        'dateC',
        'montant'
    ];



    public function caisse(){
        return $this->belongsTo(Caisse::class, 'id_caisse');
    }
}
