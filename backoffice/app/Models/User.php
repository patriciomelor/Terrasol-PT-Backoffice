<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_login',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];



    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function assignRole($role)
    {
        if (!is_numeric($role)) {
            $role = Role::where('name', $role)->firstOrFail()->id;
        }
        $this->roles()->sync([$role]);
    }

    public function syncRoles($roles)
    {
        if (is_array($roles)) {
            $roles = array_map(function ($role) {
                return is_numeric($role) ? $role : Role::where('name', $role)->firstOrFail()->id;
            }, $roles);
        } else {
            $roles = is_numeric($roles) ? $roles : Role::where('name', $roles)->firstOrFail()->id;
        }
        $this->roles()->sync($roles);
    }
    

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

}
