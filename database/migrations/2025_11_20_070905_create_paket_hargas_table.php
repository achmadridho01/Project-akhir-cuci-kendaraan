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
        Schema::create('paket_harga', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paket_cuci_id')->constrained('paket_cuci')->cascadeOnDelete();
            $table->foreignId('tipe_kendaraan_id')->constrained('tipe_kendaraan')->cascadeOnDelete();
            $table->integer('harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_hargas');
    }
};
