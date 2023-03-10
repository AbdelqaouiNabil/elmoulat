<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contrat;
class Reglement extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'dateR',
        'methode',
        'montant',
        'numero_cheque',
        'id_facture',
        'id_contrat',
    ];


    public function contrat(){
        return $this->belongsTo(Contrat::class, 'id_contrat');
    }


}
