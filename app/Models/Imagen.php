<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    protected $table = 'imagenes';    

    protected $fillable = [
        'residuo_id', 
        'ruta', 
        'fecha_subida', 
        'estado'
    ];
 
    public function residuo()
    {
        return $this->belongsTo(Residuo::class);
    }
 
    public function clasificacion()
    {
        return $this->hasOne(Clasificacion_ia::class);
    }
}
