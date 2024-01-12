<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory;
    use HasApiTokens;

    protected $fillable = [
        'name',
        'surname',
        'role',
        'email',
        'password',
        'phone',
        'avatar',
        'status',
    ];

/*     protected $hidden = [
        'password',
        'remember_token',
    ]; */

/*     protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ]; */

    public function operations()
    {
        return $this->hasMany(Operations::class);
    }
}
