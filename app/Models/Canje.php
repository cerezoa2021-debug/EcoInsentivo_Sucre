<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Canje extends Model
{
    protected $fillable = [
        'user_id', 
        'beneficio_id', 
        'fecha', 
        'puntos_utilizados', 
        'estado'
    ];
 
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
 
    public function beneficio()
    {
        return $this->belongsTo(Beneficio::class);
    }
}
