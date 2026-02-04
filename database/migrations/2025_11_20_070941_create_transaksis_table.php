<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('kendaraan_id')
                ->nullable()
                ->constrained('kendaraan')
                ->nullOnDelete();

            // 🔥 UNTUK DISKON MEMBER
            $table->foreignId('member_id')
                ->nullable()
                ->constrained('members')
                ->nullOnDelete();

            $table->string('nama_pelanggan')->nullable();
            $table->string('no_polisi')->nullable();

            $table->foreignId('tipe_kendaraan_id')
                ->constrained('tipe_kendaraan');

            $table->integer('total_harga')->default(0);

            // 🔥 DISKON
            $table->integer('diskon')->default(0); // persen
            $table->integer('total_setelah_diskon')->default(0);

            $table->string('metode_pembayaran')->nullable();
            $table->integer('bayar')->nullable();
            $table->integer('kembalian')->nullable();
            $table->timestamp('waktu_transaksi')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
