<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
        'guard_name',
        'created_by', // Agrega este campo
    ];

    public function users()
    {
        return $this->hasMany(User::class);

    }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);

    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

class Permission extends Model
{
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permissions');
    }
}
