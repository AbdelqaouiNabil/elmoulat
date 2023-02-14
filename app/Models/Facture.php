<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;
       /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fournisseur_id',
        'type',
        'numero',
        'date',
        'scan_pdf',
        'montant',
    ];

    public function fournisseur(){
        return $this->belongsTo(Fournisseur::class,'fournisseur_id');
    }
}
