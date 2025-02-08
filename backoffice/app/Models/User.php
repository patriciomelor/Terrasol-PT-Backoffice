<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\CanResetPassword;


class User extends Authenticatable implements CanResetPassword 
{
    use HasFactory, Notifiable, HasApiTokens;  
    protected $dates = ['created_at', 'updated_at', 'last_login_at'];

    protected $fillable = [
        'name',
        'email',
        'password',
        'user_login',
        'role_id',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

   
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'user_login' => 'required|string|max:255|unique:users',
            'role_id' => 'required|exists:roles,id',
        ];
    }
}
