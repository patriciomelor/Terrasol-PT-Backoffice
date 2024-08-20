<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    // Si no necesitas campos adicionales, este sería el modelo básico.
    protected $fillable = ['name'];

    /**
     * Relación con el modelo Role.
     * 
     * Un permiso puede pertenecer a muchos roles.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
