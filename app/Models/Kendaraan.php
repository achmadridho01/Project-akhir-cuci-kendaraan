<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    //  FIX UTAMA
    protected $table = 'kendaraan';

    protected $fillable = [
        'member_id',
        'nama_pemilik',
        'no_plat',
        'tipe_kendaraan_id',
        'merk',
        'telepon',
    ];

    public function tipeKendaraan()
    {
        return $this->belongsTo(TipeKendaraan::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

   
}
