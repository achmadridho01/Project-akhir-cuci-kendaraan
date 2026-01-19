<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipeKendaraan extends Model
{
    use HasFactory;

    protected $table = 'tipe_kendaraan';

    protected $fillable = ['nama_tipe'];

    // Relasi ke kendaraan
    public function kendaraan()
    {
        return $this->hasMany(Kendaraan::class);
    }

    // Relasi ke paket harga
    public function paketHarga()
    {
        return $this->hasMany(PaketHarga::class);
    }

    // Relasi ke transaksi item
    public function transaksiItem()
    {
        return $this->hasMany(TransaksiItem::class);
    }
}
