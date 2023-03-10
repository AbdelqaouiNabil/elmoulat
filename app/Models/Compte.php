<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    use HasFactory;
    use HasFactory;
    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
   protected $fillable = [
       'id',
       'bank_id',
       'numero',
       'date_creation',
       'sold'
       
       
       
   ];

   public function bank(){
    return $this->belongsTo(Bank::class,'bank_id');
   }

   
}
