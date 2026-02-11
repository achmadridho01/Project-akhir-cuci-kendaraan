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
    'tipe_kendaraan_id',
    'member_id',
    'nama_pelanggan',
    'no_polisi',
    'kode_member',
    'total_harga',
    'diskon',
    'bayar',
    'kembalian',
    'metode_pembayaran',
    'waktu_transaksi',
];



    protected $casts = [
        'waktu_transaksi' => 'datetime',
    ];

    // RELASI KE KENDARAAN
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }

    // RELASI KE TIPE KENDARAAN
    public function tipeKendaraan()
    {
        return $this->belongsTo(TipeKendaraan::class);
    }

    // RELASI KE ITEM TRANSAKSI
    public function items()
    {
        return $this->hasMany(TransaksiItem::class);
    }

    // RELASI KE USER (KASIR)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // RELASI KE MEMBER
    public function member()
    {
        return $this->belongsTo(\App\Models\Member::class, 'member_id', 'id');
    }

    // RELASI KE PAKET TAMBAHAN
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

    
    public function rating()
    {
        return $this->hasOne(Rating::class);
    }

    public function kasir()
{
    return $this->belongsTo(User::class, 'user_id'); 

}

}
