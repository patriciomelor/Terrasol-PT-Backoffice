<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    // Definir los campos que se pueden asignar masivamente
    protected $fillable = ['user_id', 'description'];

    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
