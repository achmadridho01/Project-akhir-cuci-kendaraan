<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
{
    Schema::table('kendaraan', function (Blueprint $table) {
        // JANGAN tambah kolom lagi
        // Hanya foreign key saja (kalau belum ada)
        $table->foreign('member_id')
              ->references('id')
              ->on('members')
              ->onDelete('set null');
    });
}

public function down()
{
    Schema::table('kendaraan', function (Blueprint $table) {
        $table->dropForeign(['member_id']);
    });
}

};
