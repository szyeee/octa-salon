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
        Schema::create('reservation_slots', function (Blueprint $table) {
            $table->id('id_reservationSlot');
            $table->foreignId('id_reservation')->constrained('reservations', 'id_reservation')->onDelete('cascade');
            $table->foreignId('id_slot')->constrained('slot_times', 'id_slot')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_slots');
    }
};
