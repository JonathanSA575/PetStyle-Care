<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        Service::truncate(); // Limpiar tabla

        // 1. PASEO
        Service::create([
            'name' => 'Servicio de paseo',
            'slug' => 'paseo',
            'description' => "Los paseos caninos son esenciales para el bienestar físico y emocional.",
            'image_path' => 'https://images.unsplash.com/photo-1601758228041-f3b2795255f1?auto=format&fit=crop&w=800&q=80',
            'addons' => json_encode([
                ['title' => 'Baño rápido', 'desc' => 'Enjuague ligero.'],
                ['title' => 'Limpieza de patas', 'desc' => 'Desinfección profunda.'],
                ['title' => 'Fotos', 'desc' => 'Evidencia multimedia.'],
                ['title' => 'Recolección', 'desc' => 'Vamos por él a tu casa.']
            ])
        ]);

        // 2. ESTÉTICA
        Service::create([
            'name' => 'Servicio de estética',
            'slug' => 'estetica',
            'description' => "Cuidamos la imagen y bienestar de tu mascota.",
            'image_path' => 'https://images.unsplash.com/photo-1516734212186-a967f81ad0d7?auto=format&fit=crop&w=800&q=80',
            'addons' => json_encode([
                ['title' => 'Masaje relajante', 'desc' => 'Previo al corte.'],
                ['title' => 'Limpieza dental', 'desc' => 'Cepillado profundo.'],
                ['title' => 'Anti-pulgas', 'desc' => 'Pipeta preventiva.'],
                ['title' => 'Corte de uñas', 'desc' => 'Limado suave.']
            ])
        ]);

        // 3. SPA
        Service::create([
            'name' => 'Servicio de spa',
            'slug' => 'spa',
            'description' => "Relajación total con aromaterapia.",
            'image_path' => 'https://images.unsplash.com/photo-1537151608828-ea2b11777ee8?auto=format&fit=crop&w=800&q=80',
            'addons' => json_encode([
                ['title' => 'Masaje aceites', 'desc' => 'Lavanda y manzanilla.'],
                ['title' => 'Baño burbujas', 'desc' => 'Microburbujas.'],
                ['title' => 'Aromaterapia', 'desc' => 'Esencias naturales.'],
                ['title' => 'Mascarilla', 'desc' => 'Colágeno capilar.']
            ])
        ]);
    }
}