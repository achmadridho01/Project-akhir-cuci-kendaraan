<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipeKendaraan;

class TipeKendaraanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama_tipe' => 'Motor'],
            ['nama_tipe' => 'Mobil Kecil'],
            ['nama_tipe' => 'Mobil Sedang'],
            ['nama_tipe' => 'Mobil Besar'],
            ['nama_tipe' => 'Pickup / Box']
        ];

        TipeKendaraan::insert($data);
    }
}
