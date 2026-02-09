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
    Schema::table('transaksi', function (Blueprint $table) {
        if (!Schema::hasColumn('transaksi', 'kode_member')) {
            $table->string('kode_member')->nullable()->after('no_polisi');
        }

        if (!Schema::hasColumn('transaksi', 'total_harga_final')) {
            $table->decimal('total_harga_final', 12, 0)->default(0)->after('diskon');
        }
    });
}


};
