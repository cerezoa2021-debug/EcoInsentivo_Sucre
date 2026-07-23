<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Residuo extends Model
{

    protected $fillable = [
        'nombre', 
        'categoria', 
        'descripcion', 
        'puntos', 
        'estado'
    ];
 
    public function imagenes()
    {
        return $this->hasMany(Imagen::class);
    }
 
    public function registrosReciclaje()
    {
        return $this->hasMany(Registro_reciclaje::class);
    }
}
