<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Characteristic extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'icon'];

    public function articles()
    {
        return $this->belongsToMany(Article::class)
                    ->withPivot('icon'); // Asegúrate de que el pivot tenga el campo 'icon'
    }
}
