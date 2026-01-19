<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiTambahan extends Model
{
    protected $table = 'transaksi_tambahan';

    protected $fillable = [
        'transaksi_id',
        'paket_tambahan_id',
        'qty',
        'subtotal'
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function paketTambahan()
    {
        return $this->belongsTo(PaketTambahan::class);
    }

   

}
