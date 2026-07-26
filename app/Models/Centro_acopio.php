<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Centro_acopio extends Model
{
    protected $table = 'centros_acopios';

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

    // Guardar ubicación desde lat/lng (llamar DESPUÉS de que el modelo tenga id)
    public function setUbicacionAttribute($coords)
    {
        \DB::statement(
            'UPDATE centros_acopios SET ubicacion = ST_SetSRID(ST_MakePoint(?, ?), 4326) WHERE id = ?',
            [$coords['lng'], $coords['lat'], $this->id]
        );
    }

    // Trae latitud/longitud como columnas planas, listas para usar en Blade/JSON
    public function scopeConCoordenadas($query)
    {
        return $query->select('centros_acopios.*')
            ->selectRaw('ST_Y(ubicacion::geometry) as latitud, ST_X(ubicacion::geometry) as longitud');
    }
}

