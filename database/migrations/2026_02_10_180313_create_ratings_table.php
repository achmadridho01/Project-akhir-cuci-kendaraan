<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();

            // transaksi yang dinilai
            $table->foreignId('transaksi_id')
                  ->constrained('transaksi')
                  ->cascadeOnDelete();

           

            // kasir yang melayani (nullable jika tidak ingin track)
            $table->foreignId('kasir_id')
                  ->nullable()
                  ->constrained('users')
                  ->cascadeOnDelete();

            // nilai rating 1–5
            $table->tinyInteger('nilai_rating');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
