<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiItem extends Model
{
    protected $table = 'transaksi_item';

    protected $fillable = [
        'transaksi_id',
        'paket_harga_id',
        'paket_cuci_id',
        'tipe_kendaraan_id',
        'qty',
        'subtotal'
    ];

    // RELASI KE TRANSAKSI
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    //  RELASI KE PAKET CUCI (INI YANG KURANG)
    public function paketCuci()
    {
        return $this->belongsTo(PaketCuci::class);
    }

    //  RELASI KE PAKET HARGA
    public function paketHarga()
    {
        return $this->belongsTo(PaketHarga::class);
    }
}
