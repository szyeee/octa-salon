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
        Schema::create('slot_times', function (Blueprint $table) {
            $table->id('id_slot');
            $table->date('date');
            $table->time('start_time');
            $table->time('done_time');
            $table->string('status', 20)->default('available'); // Status slot: available/booked
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slot_times');
    }
};
