<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // ESTO ES LO QUE TE FALTA HERMANITO:
    // Aquí autorizamos qué campos se pueden guardar en la base de datos
    protected $fillable = [
        'name',
        'sku',
        'description',
        'price',
        'discount_percent',
        'image_path',
        'sizes',
        'colors',
        'category',
        'stock'
    ];

    // Esto ayuda a que cuando saques 'sizes' o 'colors', Laravel te los dé ya como array y no como texto
    protected $casts = [
        'sizes' => 'array',
        'colors' => 'array',
    ];
}