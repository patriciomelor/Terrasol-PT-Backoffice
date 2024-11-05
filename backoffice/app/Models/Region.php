<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    // Especificar el nombre de la tabla
    protected $table = 'regiones';

    // Si utilizas timestamps (created_at y updated_at)
    public $timestamps = true; // O false si no los usas

    // Relación con Comunas
    public function comunas()
    {
        return $this->hasMany(Comuna::class, 'region_id');
    }
}
