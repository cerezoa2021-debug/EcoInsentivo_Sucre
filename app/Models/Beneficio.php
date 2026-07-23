<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beneficio extends Model
{
    protected $fillable = [
        'empresa_id', 
        'nombre', 
        'descripcion', 
        'puntos_requeridos', 
        'fecha_inicio', 
        'fecha_fin', 
        'estado'
    ];
 
    public function empresa()
    {
        return $this->belongsTo(Empresa_aliada::class, 'empresa_id');
    }
 
    public function canjes()
    {
        return $this->hasMany(Canje::class);
    }
}
