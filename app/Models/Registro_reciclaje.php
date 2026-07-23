<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registro_reciclaje extends Model
{
    protected $table = 'registro_reciclajes';

    protected $fillable = [
        'user_id', 
        'residuo_id', 
        'centro_id', 
        'cantidad', 
        'puntos_generados', 
        'fecha', 
        'estado'
    ];
 
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
 
    public function residuo()
    {
        return $this->belongsTo(Residuo::class);
    }
 
    public function centroAcopio()
    {
        return $this->belongsTo(Centro_acopio::class, 'centro_id');
    }
}
