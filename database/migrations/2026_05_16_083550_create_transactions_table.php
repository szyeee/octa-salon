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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('id_transaction');
            $table->foreignId('id_reservation')
                ->nullable() // agar bisa dikosongkan untuk transaksi manual/walk-in
                ->constrained('reservations', 'id_reservation')
                ->onDelete('cascade');

            $table->string('customer_name')->nullable(); // Untuk mencatat nama pembeli walk-in/produk
            $table->decimal('amount', 10, 2)->default(0); // total pembayaran
            $table->string('status', 20)->default('paid'); // Status pembayaran: paid/unpaid
            $table->timestamp('payment_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
