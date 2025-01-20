<?php
// app/Models/Comuna.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comuna extends Model
{
    protected $table = 'comunas';
    public $timestamps = true;

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id'); 
    }
}