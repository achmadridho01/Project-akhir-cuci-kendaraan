<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketTambahan extends Model
{
    protected $table = 'paket_tambahan';

    protected $fillable = [
        'nama_tambahan',
        'deskripsi',
        'harga'
    ];
}
