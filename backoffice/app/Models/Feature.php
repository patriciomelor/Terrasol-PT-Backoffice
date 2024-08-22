<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    public function articles()
    {
        return $this->belongsToMany(Article::class)->withPivot('value');
    }
}
