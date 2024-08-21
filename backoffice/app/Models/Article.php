<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'description',
        'square_meters',
        'constructed_meters',
        'region',
        'city',
        'street',
        'sale_or_rent',
        'photos',
    ];
    public function features()
    {
        return $this->belongsToMany(Feature::class)->withPivot('value');
    }
    public function characteristics()
    {
        return $this->belongsToMany(Characteristic::class)
                    ->withPivot('icon'); // Asegúrate de que el pivot tenga el campo 'icon'
    }

}
