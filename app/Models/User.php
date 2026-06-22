<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'created_by');
    }

    public function priceSimulations()
    {
        return $this->hasMany(PriceSimulation::class, 'created_by');
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'created_by');
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
