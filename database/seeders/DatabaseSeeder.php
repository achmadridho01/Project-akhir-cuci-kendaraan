<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\TipeKendaraan;
use App\Models\PaketCuci;
use App\Models\PaketHarga;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            UserSeeder::class,
            TipeKendaraanSeeder::class,
            KendaraanSeeder::class,
        ]);


        
        // ===========================================================
        // TIPE KENDARAAN
        // ===========================================================
        $tipe = [
            'Motor',
            'Mobil Kecil',
            'Mobil Sedang',
            'Mobil Besar',
        ];

        $tipeList = [];
        foreach ($tipe as $t) {
            $tipeList[] = TipeKendaraan::create(['nama_tipe' => $t]);
        }

        // ===========================================================
        // PAKET CUCI
        // ===========================================================
        $paket = [
            'Cuci Biasa' => 'Pencucian standar.',
            'Cuci Premium' => 'Pencucian premium dengan wax.',
            'Cuci Salju' => 'Pencucian menggunakan busa snow.',
        ];

        $paketList = [];
        foreach ($paket as $nama => $desk) {
            $paketList[] = PaketCuci::create([
                'nama_paket' => $nama,
                'deskripsi' => $desk,
            ]);
        }

        // ===========================================================
        // PAKET HARGA
        // otomatis generate harga untuk setiap kombinasi
        // ===========================================================
        foreach ($paketList as $p) {
            foreach ($tipeList as $t) {

                // Harga otomatis (boleh diubah)
                // Motor lebih murah, mobil lebih mahal
                $randomHarga = match ($t->nama_tipe) {
                    'Motor' => rand(15000, 25000),
                    'Mobil Kecil' => rand(25000, 40000),
                    'Mobil Sedang' => rand(40000, 60000),
                    'Mobil Besar' => rand(60000, 90000),
                    default => rand(20000, 50000)
                };

                PaketHarga::create([
                    'paket_cuci_id' => $p->id,
                    'tipe_kendaraan_id' => $t->id,
                    'harga' => $randomHarga,
                ]);
            }
        }
    }
}
