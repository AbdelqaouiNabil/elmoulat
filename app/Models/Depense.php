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
        'id_project',
        'id_ouvrier',
        'id_facture',
        'dateDep',
        'description',
        'situation',
        'methode',
        'type_depense',
        'montant',
        'ref_verement',
        'numero_cheque'
    ];

    public function project(){
        return $this->belongsTo(Projet::class, 'id_project');
    }

    public function ouvrier(){
        return $this->belongsTo(Ouvrier::class, 'id_ouvrier');
    }
    public function retrait(){
        return $this->belongsTo(Retrait::class, 'id_retrait');
    }
    public function facture(){
        return $this->belongsTo(Facture::class, 'id_facture');
    }


}
