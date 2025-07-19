<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // 👈 Quan trọng
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable  // 👈 Phải kế thừa Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'username',
        'email',
        'password_hash',
        'name',
        'phone',
        'address',
        'role_id',
    ];

    protected $hidden = [
        'password_hash',
        'remember_token',
    ];

    protected $attributes = [
        'role_id' => 1,
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password_hash' => 'hashed',
        ];
    }

    public function getAuthPassword()
    {
        return $this->password_hash;
    }
    public function reviews()
{
    return $this->hasMany(Review::class, 'customer_id');
}
}
