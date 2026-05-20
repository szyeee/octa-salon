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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id('id_transaction_detail');

            $table->foreignId('id_transaction')
                ->constrained('transactions', 'id_transaction')
                ->onDelete('cascade');

            $table->foreignId('id_service')
                ->constrained('services', 'id_service')
                ->onDelete('restrict');

            $table->integer('quantity')->default(1);
            $table->decimal('price_at_purchase', 10, 2); // Merekam harga layanan saat hari-H transaksi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};
