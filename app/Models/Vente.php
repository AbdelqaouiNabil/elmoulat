<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_bien',
        'id_prevent',
        'id_client',
        'titre',
        'montant',
        'montantReal',
        'contrat',
        'paye',
        'reste',
        'dateV',
    
    ];

    public function client(){
        return $this->belongsTo(Client::class,'id_client');
    }
    public function prevente(){
        return $this->belongsTo(Prevente::class,'id_prevente');
    }
    public function bien(){
        return $this->belongsTo(Bien::class,'id_bien');
    }
    protected static function boot() {
        parent::boot();
    
        static::updating(function($model){
            $model->reste = $model->montantReal - $model->paye;
        }); 
        static::saving(function($model){
            $model->reste = $model->montantReal - $model->paye;
        });
    }
}
