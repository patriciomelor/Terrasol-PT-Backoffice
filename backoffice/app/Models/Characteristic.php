<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Characteristic extends Model
{
    // Characteristic.php
    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_characteristic', 'characteristic_id', 'article_id');
    }
}
