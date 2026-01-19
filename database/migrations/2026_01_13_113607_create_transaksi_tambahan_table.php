<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
    Schema::create('transaksi_tambahan', function (Blueprint $table) {
        $table->id();

        $table->unsignedBigInteger('transaksi_id');
        $table->unsignedBigInteger('paket_tambahan_id');

        $table->integer('qty')->default(1);
        $table->integer('subtotal');

        $table->timestamps();

        // FOREIGN KEY MANUAL (INI KUNCINYA 🔥)
        $table->foreign('transaksi_id')
              ->references('id')
              ->on('transaksi')
              ->onDelete('cascade');

        $table->foreign('paket_tambahan_id')
              ->references('id')
              ->on('paket_tambahan')
              ->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_tambahan');
    }
};
