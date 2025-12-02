<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('services', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Ej: Servicio de Paseo
        $table->string('slug')->unique(); // Para la URL (ej: paseo, spa)
        $table->text('description'); // El texto largo del PDF
        $table->string('image_path'); // Foto del servicio
        $table->json('addons')->nullable(); // Aquí guardaremos las checkboxes (Baño, masaje, etc.)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
