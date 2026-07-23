<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa_aliada extends Model
{
    protected $table = 'empresa_aliadas';

    protected $fillable = [
        'nombre', 
        'direccion', 
        'telefono', 
        'email', 
        'rubro', 
        'estado'
    ];
 
    public function beneficios()
    {
        return $this->hasMany(Beneficio::class, 'empresa_id');
    }
}
