<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billetera extends Model
{
    protected $fillable = [
        'user_id', 
        'saldo_puntos', 
        'fecha_actualizacion'
    ];
 
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
