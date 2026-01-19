<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketHarga extends Model
{
    protected $table = 'paket_harga';

    protected $fillable = [
        'paket_cuci_id',
        'tipe_kendaraan_id',
        'harga'
    ];

    // 🔥 FIX UTAMA DI SINI
    public function paketCuci()
    {
        return $this->belongsTo(PaketCuci::class, 'paket_cuci_id');
    }

    public function tipeKendaraan()
    {
        return $this->belongsTo(TipeKendaraan::class, 'tipe_kendaraan_id');
    }
}
