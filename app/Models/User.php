<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_approved',
        'nip',
        'no_hp',
        'alamat',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_approved' => 'boolean',
    ];
    
    /**
     * Get the nasabah assigned to this petugas.
     */
    public function nasabah()
    {
        return $this->hasMany(Nasabah::class, 'petugas_id');
    }

    // === Role constants ===
    const ROLE_SUPER_ADMIN = 'super_admin';
    const ROLE_ADMIN = 'admin';
    const ROLE_PETUGAS = 'petugas';

    // === Helper method ===
    public function isSuperAdmin(): bool
    {
        return $this->role === self::ROLE_SUPER_ADMIN;
    }
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }
    public function isPetugas(): bool
    {
        return $this->role === self::ROLE_PETUGAS;
    }
    public function isApproved(): bool
    {
        return $this->is_approved;
    }
}
