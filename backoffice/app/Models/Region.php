<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regiones'; // Nombre de la tabla en plural
    public $timestamps = true;

    protected $fillable = ['nombre']; // O $guarded = [];

    public function comunas()
    {
        return $this->hasMany(Comuna::class, 'region_id');
    }
}