<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kendaraan;

class KendaraanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'no_plat' => 'B 1234 CD',
                'nama_pemilik' => 'Andi',
                'tipe_kendaraan_id' => 2
            ],
            [
                'no_plat' => 'F 5555 AA',
                'nama_pemilik' => 'Ridho',
                'tipe_kendaraan_id' => 1
            ],
        ];

        Kendaraan::insert($data);
    }
}
