<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cheque extends Model
{
    use HasFactory;
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        
        'numero',
        'date',
        'situation',
        'id_chequier',
       
    ];

    public function chequier(){
        return $this->belongsTo(Chequier::class,'id_chequier');
    }

    
}
