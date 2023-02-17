<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caisse extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'sold_nonjustify',
        'sold',
        'total'

    ];

    protected static function boot() {
        parent::boot();
    
        static::updating(function($model){
            $model->total = $model->sold_nonjustify + $model->sold;
        }); 
        static::saving(function($model){
            $model->total = $model->sold_nonjustify + $model->sold;
        });
    }

}
