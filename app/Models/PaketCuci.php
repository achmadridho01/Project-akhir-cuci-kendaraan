<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaketCuci extends Model
{
    use HasFactory;

    protected $table = 'paket_cuci';

    protected $fillable = ['nama_paket', 'deskripsi'];

    public function harga()
    {
        return $this->hasMany(PaketHarga::class, 'paket_cuci_id');
    }

    public function transaksiItem()
    {
        return $this->hasMany(TransaksiItem::class, 'paket_cuci_id');
    }
}
