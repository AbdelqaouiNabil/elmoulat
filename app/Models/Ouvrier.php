<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\f_domaine;

class Ouvrier extends Model
{
    use HasFactory;
      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'nom',
        'datenais',
        'cin',
        'n_cin',
        'datedubet',
        'observation',
        'notation',
        'phone',
        'email',
        'adress',
        'id_domaine',
    ];
    public function domaine(){
        return $this->belongsTo(f_domaine::class,'id_domaine');
    }
}
