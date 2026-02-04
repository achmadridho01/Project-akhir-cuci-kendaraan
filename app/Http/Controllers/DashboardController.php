<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;
use App\Models\PaketCuci;
use App\Models\TipeKendaraan;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Pendapatan
        $totalPendapatan = Transaksis::sum('total_harga');

        // Total Transaksi Hari Ini
        $transaksiHariIni = Transaksis::whereDate('created_at', now()->toDateString())->count();

        // Pendapatan per paket cuci (pakai subtotal)
        $pendapatanPerPaket = PaketCuci::leftJoin('transaksi_item', 'paket_cuci.id', '=', 'transaksi_item.paket_cuci_id')
            ->leftJoin('transaksi', 'transaksi_item.transaksi_id', '=', 'transaksi.id')
            ->select('paket_cuci.nama_paket', DB::raw('SUM(transaksi_item.subtotal) as total'))
            ->groupBy('paket_cuci.nama_paket')
            ->get();

        // Pendapatan per tipe kendaraan
        $pendapatanPerTipe = TipeKendaraan::leftJoin('kendaraan', 'tipe_kendaraan.id', '=', 'kendaraan.tipe_kendaraan_id')
            ->leftJoin('transaksi', 'kendaraan.id', '=', 'transaksi.kendaraan_id')
            ->select('tipe_kendaraan.nama_tipe', DB::raw('SUM(transaksi.total_harga) as total'))
            ->groupBy('tipe_kendaraan.nama_tipe')
            ->get();

        // Jumlah kendaraan per tipe (TAMBAHAN)
        $kendaraanPerTipe = TipeKendaraan::leftJoin('kendaraan', 'tipe_kendaraan.id', '=', 'kendaraan.tipe_kendaraan_id')
            ->select('tipe_kendaraan.nama_tipe', DB::raw('COUNT(kendaraan.id) as total'))
            ->groupBy('tipe_kendaraan.nama_tipe')
            ->get();


            // Paket tambahan
            $pendapatanPerPaketTambahan = DB::table('transaksi_tambahan')
    ->join('paket_tambahan', 'paket_tambahan.id', '=', 'transaksi_tambahan.paket_tambahan_id')
    ->select(
        'paket_tambahan.nama_tambahan',
        DB::raw('SUM(transaksi_tambahan.subtotal) as total')
    )
    ->groupBy('paket_tambahan.nama_tambahan')
    ->get();


        // Transaksi terbaru
        $transaksiTerbaru = Transaksi::with('kendaraan')
            ->orderBy('id', 'DESC')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalPendapatan',
            'transaksiHariIni',
            'pendapatanPerPaket',
            'pendapatanPerTipe',
            'kendaraanPerTipe',   // <-- INI YANG KURANG
            'transaksiTerbaru',
            'pendapatanPerPaketTambahan'
            
        ));


        
    }


    
}

