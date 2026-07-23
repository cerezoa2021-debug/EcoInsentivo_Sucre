<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Centro_acopio extends Model
{
    protected $table = 'centro_acopios';

    protected $fillable = [
        'nombre', 
        'direccion', 
        'horario', 
        'estado'
    ];
 
    public function registrosReciclaje()
    {
        return $this->hasMany(Registro_reciclaje::class, 'centro_id');
    }
 
    // Guardar ubicación desde lat/lng de PostGIS
    public function setUbicacionAttribute($coords)
    {
    
        \DB::statement(
            'UPDATE centros_acopios SET ubicacion = ST_SetSRID(ST_MakePoint(?, ?), 4326) WHERE id = ?',
            [$coords['lng'], $coords['lat'], $this->id]
        );
    }
}
