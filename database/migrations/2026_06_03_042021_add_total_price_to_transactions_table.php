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
        Schema::table('transactions', function (Blueprint $table) {
            // Menambahkan kolom total_price jika belum ada di postgres
            if (!Schema::hasColumn('transactions', 'total_price')) {
                $table->decimal('total_price', 15, 2)->default(0);
            }
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('total_price');
        });
    }
};
