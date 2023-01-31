<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\f_domaine;

class Fournisseur extends Model
{
    use HasFactory;
      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_fdomaine',
        'name',
        'ice',
        'phone',
        'email',
        'adress',
    ];
    public function domaine(){
        
    }

    public function charge(){
        return $this->hasMany('App\Models\Charge');
    }


}
