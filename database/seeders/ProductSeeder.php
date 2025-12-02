<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::truncate(); // Borramos todo para empezar limpio

        // ==========================================
        // 1. CATEGORÍA: ALIMENTO (15 Productos)
        // ==========================================
        $alimentos = [
            ['Ganador Premium Adulto', 'Ganador', 138.00],
            ['Ganador Cachorro', 'Ganador', 129.50],
            ['Dog Chow Adultos Minis', 'Dog Chow', 145.00],
            ['Dog Chow Digestión Sana', 'Dog Chow', 160.00],
            ['Pedigree Adulto Res', 'Pedigree', 110.00],
            ['Pedigree Cachorro Pollo', 'Pedigree', 115.00],
            ['Nupec Adulto', 'Nupec', 250.00],
            ['Nupec Senior', 'Nupec', 260.00],
            ['Royal Canin Mini', 'Royal Canin', 350.00],
            ['Pro Plan OptiHealth', 'Pro Plan', 400.00],
            ['Beneful Salmón', 'Beneful', 180.00],
            ['Mainstay Clásico', 'Mainstay', 90.00],
            ['Campeón Pollo', 'Campeón', 85.00],
            ['Eukanuba Adulto', 'Eukanuba', 320.00],
            ['Hills Science Diet', 'Hills', 450.00],
        ];

        foreach ($alimentos as $index => $item) {
            Product::create([
                'name' => $item[0],
                'brand' => $item[1],
                'sku' => 'ALI-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'description' => 'Alimento balanceado de alta calidad para el cuidado de tu mascota.',
                'price' => $item[2],
                'image_path' => 'alimento.png', // Tu imagen local
                'category' => 'Alimento',
                'stock' => rand(10, 50),
                'sizes' => json_encode(['2kg', '4kg', '10kg']),
            ]);
        }

        // ==========================================
        // 2. CATEGORÍA: JUGUETES (15 Productos)
        // ==========================================
        $juguetes = [
            ['Pelota Resistente Kong', 'Kong', 220.00],
            ['Pollo de Hule con Sonido', 'Fancy Pets', 65.00],
            ['Cuerda Mordedera Multicolor', 'PetToys', 85.00],
            ['Frisbee de Goma', 'Kong', 150.00],
            ['Hueso Saborizado', 'Nylabone', 120.00],
            ['Peluche de Ardilla', 'Fancy Pets', 95.00],
            ['Lanzador de Pelotas', 'Chuckit', 300.00],
            ['Mordedera de Caucho', 'PetStyle', 70.00],
            ['Rompecabezas Interactivo', 'Nina Ottosson', 450.00],
            ['Kong Rellenable Clásico', 'Kong', 280.00],
            ['Pato de Peluche', 'Fancy Pets', 110.00],
            ['Aro de Entrenamiento', 'PetToys', 90.00],
            ['Túnel Plegable', 'PetStyle', 350.00],
            ['Pelota con Luz LED', 'Nerf Dog', 180.00],
            ['Juguete Chillón Hamburguesa', 'Fancy Pets', 55.00],
        ];

        foreach ($juguetes as $index => $item) {
            Product::create([
                'name' => $item[0],
                'brand' => $item[1],
                'sku' => 'JUG-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'description' => 'Diversión garantizada para evitar el aburrimiento y estrés.',
                'price' => $item[2],
                'image_path' => 'juguetes.png',
                'category' => 'Juguetes',
                'stock' => rand(5, 30),
            ]);
        }

        // ==========================================
        // 3. CATEGORÍA: ROPA (15 Productos)
        // ==========================================
        $ropa = [
            ['Suéter Navideño Rojo', 'PetFashion', 250.00, 'ropa.png'],
            ['Impermeable Amarillo', 'PetStyle', 320.00, 'ropa.png'],
            ['Playera I Love Mom', 'PetFashion', 120.00, 'ropa.png'],
            ['Sudadera Deportiva Gris', 'AdidasPet', 280.00, 'ropa.png'],
            ['Disfraz de Calabaza', 'HalloweenPets', 300.00, 'halloween.png'], // Ojo aquí con la imagen
            ['Abrigo Invernal Azul', 'PetStyle', 450.00, 'invierno.png'],     // Ojo aquí
            ['Vestido de Gala Rosa', 'Fancy Pets', 350.00, 'ropa.png'],
            ['Impermeable Camuflaje', 'PetStyle', 330.00, 'ropa.png'],
            ['Botitas para Lluvia', 'PetFashion', 150.00, 'ropa.png'],
            ['Pañoleta de Cumpleaños', 'PartyPet', 80.00, 'ropa.png'],
            ['Chaleco Reflejante', 'SecurityPet', 200.00, 'ropa.png'],
            ['Disfraz de Superhéroe', 'HalloweenPets', 380.00, 'halloween.png'],
            ['Pijama de Ositos', 'SleepyPet', 220.00, 'ropa.png'],
            ['Gorra para Sol', 'PetStyle', 90.00, 'ropa.png'],
            ['Bufanda Tejida', 'WinterPet', 100.00, 'invierno.png'],
        ];

        foreach ($ropa as $index => $item) {
            Product::create([
                'name' => $item[0],
                'brand' => $item[1],
                'sku' => 'ROP-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'description' => 'Estilo y comodidad para cualquier clima u ocasión.',
                'price' => $item[2],
                'image_path' => $item[3], // Usamos la imagen específica
                'category' => in_array($item[3], ['halloween.png', 'invierno.png']) ? 'Temporada' : 'Ropa',
                'stock' => rand(10, 20),
                'sizes' => json_encode(['CH', 'M', 'G']),
            ]);
        }

        // ==========================================
        // 4. CATEGORÍA: ACCESORIOS (15 Productos)
        // ==========================================
        $accesorios = [
            ['Collar de Piel Ajustable', 'Fancy Pets', 180.00],
            ['Placa Huesito Grabable', 'PetID', 50.00],
            ['Cama Acolchada Grande', 'DescansoPet', 850.00],
            ['Correa Retráctil 5m', 'Flexi', 350.00],
            ['Plato de Acero Inoxidable', 'PetStyle', 120.00],
            ['Transportadora Rígida', 'PetTravel', 900.00],
            ['Bolsas para Desechos', 'CleanPet', 40.00],
            ['Cepillo Quita Pelo', 'Furminator', 250.00],
            ['Arnés Pechera Acojinado', 'PetStyle', 280.00],
            ['Mochila para Gato/Perro', 'PetTravel', 600.00],
            ['Bebedero Portátil', 'AquaDog', 150.00],
            ['Cubre Asientos Auto', 'CarPet', 400.00],
            ['Puerta para Perro', 'Staywell', 1200.00],
            ['GPS Rastreador', 'Tractive', 1500.00],
            ['Tapete Entrenador', 'PuppyTraining', 300.00],
        ];

        foreach ($accesorios as $index => $item) {
            Product::create([
                'name' => $item[0],
                'brand' => $item[1],
                'sku' => 'ACC-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'description' => 'Accesorios esenciales para el día a día de tu mejor amigo.',
                'price' => $item[2],
                'image_path' => 'accesorios.png',
                'category' => 'Accesorios',
                'stock' => rand(5, 50),
                'colors' => json_encode(['Negro', 'Rojo', 'Azul']),
            ]);
        }
    }
}