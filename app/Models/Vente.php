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
        'project_id',
        'client_id',
        'titre',
        'montant',
        'montantReal',
        'contrat',
        'paye',
        'reste',
        'dateV',
    
    ];

    public function client(){
        return $this->belongsTo(Client::class,'client_id');
    }
    public function project(){
        return $this->belongsTo(Projet::class,'project_id');
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
