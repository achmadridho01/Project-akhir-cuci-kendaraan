<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // ======================
        // RANGE TANGGAL
        // ======================
        $dari = $request->dari ?? Carbon::now()->startOfMonth()->toDateString();
        $sampai = $request->sampai ?? Carbon::now()->endOfMonth()->toDateString();

        // ======================
        // QUERY DASAR
        // ======================
        $query = Transaksi::whereBetween('waktu_transaksi', [
            $dari . ' 00:00:00',
            $sampai . ' 23:59:59'
        ]);

        // ======================
        // FILTER NAMA PELANGGAN
        // ======================
        if ($request->filled('pelanggan')) {
            $query->where('nama_pelanggan', 'like', '%' . $request->pelanggan . '%');
        }

        // ======================
        // AMBIL DATA
        // ======================
        $transaksi = (clone $query)
            ->with(['user', 'kendaraan'])
            ->orderBy('waktu_transaksi', 'DESC')
            ->get();

        // ======================
        // RINGKASAN
        // ======================
        $jumlahTransaksi = $transaksi->count();
        $totalPendapatan = $transaksi->sum('total_harga');

        $cash = $transaksi
            ->where('metode_pembayaran', 'cash')
            ->sum('total_harga');

        $transfer = $transaksi
            ->where('metode_pembayaran', 'transfer')
            ->sum('total_harga');

        return view('admin.laporan.index', compact(
            'dari',
            'sampai',
            'transaksi',
            'jumlahTransaksi',
            'totalPendapatan',
            'cash',
            'transfer'
        ));
    }

    public function print(Request $request)
{
    $dari = $request->dari;
    $sampai = $request->sampai;

    $query = Transaksi::whereBetween('waktu_transaksi', [
        $dari.' 00:00:00',
        $sampai.' 23:59:59'
    ]);

    if ($request->pelanggan) {
        $query->where('nama_pelanggan', 'like', '%'.$request->pelanggan.'%');
    }

    $transaksi = $query->orderBy('waktu_transaksi')->get();

    return view('admin.laporan.print', [
        'transaksi' => $transaksi,
        'jumlahTransaksi' => $transaksi->count(),
        'totalPendapatan' => $transaksi->sum('total_harga'),
        'cash' => $transaksi->where('metode_pembayaran','cash')->sum('total_harga'),
        'transfer' => $transaksi->where('metode_pembayaran','transfer')->sum('total_harga'),
        'dari' => $dari,
        'sampai' => $sampai,
    ]);
}


}
