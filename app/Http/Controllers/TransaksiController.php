<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
use App\Models\TransaksiTambahan;
use App\Models\Kendaraan;
use App\Models\PaketHarga;
use App\Models\PaketTambahan;
use App\Models\Member;

class TransaksiController extends Controller
{
    public function create()
    {
        return view('transaksi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'tipe_kendaraan_id' => 'required',
            'paket' => 'required',
            'metode_pembayaran' => 'required|in:cash,transfer',
        ]);

        $transaksi = null;

        DB::transaction(function () use ($request, &$transaksi) {

            // ================= KENDARAAN =================
            $kendaraan = Kendaraan::firstOrCreate(
                ['no_plat' => $request->no_plat],
                [
                    'nama_pemilik' => $request->nama_pelanggan,
                    'telepon' => $request->telepon,
                    'merk' => $request->merk,
                    'tipe_kendaraan_id' => $request->tipe_kendaraan_id,
                ]
            );

            // ambil member dari kendaraan (jika ada)
            $member = $kendaraan->member;

            // ================= TRANSAKSI =================
            $transaksi = Transaksi::create([
                'user_id' => auth()->id(),
                'kendaraan_id' => $kendaraan->id,
                'member_id' => $member?->id,
                'nama_pelanggan' => $request->nama_pelanggan,
                'no_polisi' => $request->no_plat,
                'tipe_kendaraan_id' => $request->tipe_kendaraan_id,
                'total_harga' => 0,
                'diskon' => 0,
                'total_harga_final' => 0,
                'metode_pembayaran' => $request->metode_pembayaran,
                'bayar' => $request->metode_pembayaran === 'cash' ? $request->bayar : null,
                'kembalian' => 0,
                'waktu_transaksi' => now(),
            ]);

            // ================= PAKET UTAMA =================
            $paketHarga = PaketHarga::with('paketCuci')->findOrFail($request->paket);
            $subtotalPaket = $paketHarga->harga;

            TransaksiItem::create([
                'transaksi_id' => $transaksi->id,
                'paket_harga_id' => $paketHarga->id,
                'paket_cuci_id' => $paketHarga->paket_cuci_id,
                'tipe_kendaraan_id' => $paketHarga->tipe_kendaraan_id,
                'qty' => 1,
                'subtotal' => $subtotalPaket,
            ]);

            // ================= PAKET TAMBAHAN =================
            $totalTambahan = 0;

            if ($request->paket_tambahan) {
                $paketTambahans = PaketTambahan::whereIn('id', $request->paket_tambahan)->get();

                foreach ($paketTambahans as $pt) {
                    TransaksiTambahan::create([
                        'transaksi_id' => $transaksi->id,
                        'paket_tambahan_id' => $pt->id,
                        'qty' => 1,
                        'harga' => $pt->harga,
                        'subtotal' => $pt->harga,
                    ]);

                    $totalTambahan += $pt->harga;
                }
            }

            // ================= TOTAL & DISKON =================
            $total = $subtotalPaket + $totalTambahan;
            $diskon = 0;

            if ($member) {
                $totalTransaksiMember = Transaksi::where('member_id', $member->id)->count();

                // diskon berlaku setelah 5x transaksi
                if ($totalTransaksiMember >= 5) {
                    $diskon = $total * 0.5;
                }
            }

            $totalFinal = $total - $diskon;
            $bayar = (int) $request->bayar;
            $kembalian = max(0, $bayar - $totalFinal);

            $transaksi->update([
                'total_harga' => $total,
                'diskon' => $diskon,
                'total_harga_final' => $totalFinal,
                'bayar' => $request->metode_pembayaran === 'cash' ? $bayar : null,
                'kembalian' => $request->metode_pembayaran === 'cash' ? $kembalian : null,
            ]);
        });

        if ($request->metode_pembayaran === 'transfer') {
            return view('transaksi.qris', [
                'transaksi' => $transaksi,
                'qris_toko' => 'https://link-qris-toko.com/123456'
            ]);
        }

        return redirect()
            ->route('transaksi.struk', $transaksi->id)
            ->with('success', 'Transaksi berhasil');
    }

    public function struk($id)
    {
        $transaksi = Transaksi::with([
            'kendaraan',
            'member',
            'items.paketCuci',
            'items.paketHarga',
            'tambahans.paketTambahan',
            'user'
        ])->findOrFail($id);

        return view('transaksi.struk', compact('transaksi'));
    }
}
