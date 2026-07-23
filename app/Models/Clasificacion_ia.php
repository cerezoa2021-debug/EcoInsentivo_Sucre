<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clasificacion_ia extends Model
{
    protected $table = 'clasificacion_ias';

    protected $fillable = [
        'imagen_id', 
        'tipo_detectado', 
        'confianza', 
        'modelo', 
        'fecha'
    ];
 
    public function imagen()
    {
        return $this->belongsTo(Imagen::class);
    }
}
