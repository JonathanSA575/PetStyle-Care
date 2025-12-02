<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'image_path', 'addons'];

    // ¡ESTA ES LA CLAVE! 
    // Le dice a Laravel: "El campo 'addons' es JSON, conviértelo a Array automáticamente"
    protected $casts = [
        'addons' => 'array',
    ];
}