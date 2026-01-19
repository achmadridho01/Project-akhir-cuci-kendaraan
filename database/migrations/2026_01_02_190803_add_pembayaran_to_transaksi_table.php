<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->string('metode_pembayaran')->after('total_harga');
            $table->integer('bayar')->after('metode_pembayaran')->nullable();
            $table->integer('kembalian')->after('bayar')->nullable();
            $table->timestamp('waktu_transaksi')->after('kembalian')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->dropColumn([
                'metode_pembayaran',
                'bayar',
                'kembalian',
                'waktu_transaksi'
            ]);
        });
    }
};
