<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_id')->constrained('transaksi')->cascadeOnDelete();
            $table->foreignId('paket_harga_id')->constrained('paket_harga')->cascadeOnDelete();
            $table->foreignId('paket_cuci_id')->constrained('paket_cuci');
            $table->foreignId('tipe_kendaraan_id')->constrained('tipe_kendaraan');
            $table->integer('qty')->default(1);
            $table->integer('subtotal')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_items');
    }
};
