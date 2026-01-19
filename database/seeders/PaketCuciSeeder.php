<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaketCuci;

class PaketCuciSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_paket' => 'Cuci Biasa',
                'deskripsi'  => 'Pencucian standar.'
            ],
            [
                'nama_paket' => 'Cuci Premium',
                'deskripsi'  => 'Pencucian dengan hasil lebih maksimal.'
            ],
            [
                'nama_paket' => 'Cuci Salju',
                'deskripsi'  => 'Menggunakan busa snow.'
            ],
        ];

        PaketCuci::insert($data);
    }
}
