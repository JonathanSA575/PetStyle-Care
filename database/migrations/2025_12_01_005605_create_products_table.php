<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre del producto
            $table->string('sku')->unique(); // SKU único
            $table->text('description'); // Descripción larga
            $table->decimal('price', 10, 2); // Precio con centavos
            $table->integer('discount_percent')->default(0); // Descuento
            $table->string('image_path'); // URL de la imagen
            $table->string('category'); // Alimento, Ropa, etc.
            $table->integer('stock')->default(0); // Cantidad disponible
            $table->json('sizes')->nullable(); // Tallas (Array)
            $table->json('colors')->nullable(); // Colores (Array)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};