<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transaksi_tambahan', function (Blueprint $table) {
            $table->id();

            // relasi ke transaksi
            $table->foreignId('transaksi_id')
                ->constrained('transaksi')
                ->cascadeOnDelete();

            // relasi ke paket tambahan
            $table->foreignId('paket_tambahan_id')
                ->constrained('paket_tambahan')
                ->cascadeOnDelete();

            $table->integer('qty')->default(1);
            $table->integer('harga')->default(0);
            $table->integer('subtotal')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_tambahan');
    }
};
