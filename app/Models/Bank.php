<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        
        'nom',
        'email',
        'phone',
        'adress',
        'ville', 
    ];


    public function compte(){
        return $this->hasMany(Compte::class,'bank_id');
    }
}
