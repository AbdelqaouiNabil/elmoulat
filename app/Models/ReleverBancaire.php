<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Compte;
class ReleverBancaire extends Model
{
    use HasFactory;
    protected $fillable = [
        'compte_id',
        'dateR',
        // 'operation_ref',

    ];
    public function compte(){
        return $this->belongsTo(Compte::class,'compte_id');
    }
}
