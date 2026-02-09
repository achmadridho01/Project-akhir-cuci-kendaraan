<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';

   protected $fillable = ['kode_member','nama_member','telepon'];


    public function kendaraan()
    {
        return $this->hasMany(Kendaraan::class);
    }

    public function transaksis()
{
    return $this->hasMany(\App\Models\Transaksi::class, 'member_id');
}

}
