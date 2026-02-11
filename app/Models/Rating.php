<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
   protected $fillable = [
    'transaksi_id',
    'user_id',
    'kasir_id',
    'nilai_rating'
];

public function kasir()
{
    return $this->belongsTo(User::class, 'kasir_id');
}

public function transaksi()
{
    return $this->belongsTo(Transaksi::class, 'transaksi_id');
}
}