<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comuna extends Model
{
    // Especificar el nombre de la tabla
    protected $table = 'comunas';

    public $timestamps = true; // O false si no usas timestamps

    // Relación con Region
    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }
}
