<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Los atributos que se pueden llenar masivamente.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'avatar',
        'phone',    // <--- Nuevo
        'city',     // <--- Nuevo
        'address',  // <--- Nuevo
    ];

    /**
     * Los atributos que deben estar ocultos.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Los atributos que se deben castear.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}