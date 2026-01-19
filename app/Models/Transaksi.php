<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TransaksiTambahan;


class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
    'user_id',
    'kendaraan_id',
    'nama_pelanggan',
    'no_polisi',
    'tipe_kendaraan_id',
    'total_harga',
    'metode_pembayaran',
    'bayar',
    'kembalian',
    'waktu_transaksi',
];

 // ✅ INI KUNCINYA
    protected $casts = [
        'waktu_transaksi' => 'datetime',
    ];


    // 🔗 RELASI KE KENDARAAN (INI YANG ERROR TADI)
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }

    // 🔗 RELASI KE TIPE KENDARAAN
    public function tipeKendaraan()
    {
        return $this->belongsTo(TipeKendaraan::class);
    }

    // 🔗 RELASI KE ITEM TRANSAKSI
    public function items()
    {
        return $this->hasMany(TransaksiItem::class);
    }

    // 🔗 RELASI KE USER (KASIR)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paketTambahan()
{
    return $this->belongsToMany(
        \App\Models\PaketTambahan::class,
        'transaksi_tambahan'
    )->withPivot('qty', 'subtotal');
}

public function tambahans()
{
    return $this->hasMany(TransaksiTambahan::class, 'transaksi_id');
}



}
