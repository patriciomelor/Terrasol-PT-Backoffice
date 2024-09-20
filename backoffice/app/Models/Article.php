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
            'cover_photo',
        ];
    
        protected $casts = [
            'photos' => 'array',
        ];
    
        public function characteristics()
        {
            return $this->belongsToMany(Characteristic::class);
        }
        
}
