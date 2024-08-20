<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class);

    }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }
}

class Permission extends Model
{
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permissions');
    }
}
