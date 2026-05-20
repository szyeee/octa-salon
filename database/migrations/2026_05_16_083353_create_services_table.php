<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id('id_service');
            $table->string('name', 100); // Nama layanan, misal Potong Rambut, Cat Rambut, dll.
            $table->text('description')->nullable(); // Deskripsi layanan, opsional
            $table->decimal('price', 10, 2);
            $table->integer('duration'); // Durasi layanan
            $table->string('image')->nullable();
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
