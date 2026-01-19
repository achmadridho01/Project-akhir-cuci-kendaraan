<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixTransaksiItemsNullable extends Migration
{
    public function up()
    {
        Schema::table('transaksi_item', function (Blueprint $table) {
            $table->unsignedBigInteger('paket_harga_id')->nullable()->change();
            $table->unsignedBigInteger('paket_tambahan_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('transaksi_item', function (Blueprint $table) {
            $table->unsignedBigInteger('paket_harga_id')->nullable(false)->change();
            $table->unsignedBigInteger('paket_tambahan_id')->nullable(false)->change();
        });
    }
}
