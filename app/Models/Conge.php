<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employe;

class Conge extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        
        'employe_id',
        'type',
        'date_debut',
        'date_fin',
        'jours',
    ];

    public function employe(){
        return $this->belongsTo(Employe::class,'employe_id');
    }
}
