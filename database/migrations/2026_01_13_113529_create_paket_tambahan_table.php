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
    Schema::create('paket_tambahan', function (Blueprint $table) {
        $table->id();
        $table->string('nama_tambahan');
        $table->text('deskripsi')->nullable();
        $table->integer('harga');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_tambahan');
    }
};
