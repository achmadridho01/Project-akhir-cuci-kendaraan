<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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

            // ================= TRANSAKSI AWAL =================
            $transaksi = Transaksi::create([
                'user_id' => auth()->id(),
                'kendaraan_id' => $kendaraan->id,
                'nama_pelanggan' => $request->nama_pelanggan,
                'no_polisi' => $request->no_plat,
                'tipe_kendaraan_id' => $request->tipe_kendaraan_id,
                'kode_member' => $request->kode_member,
                'total_harga' => 0,
                'diskon' => 0,
                'total_harga_final' => 0,
                'metode_pembayaran' => $request->metode_pembayaran,
                'bayar' => $request->metode_pembayaran === 'cash' ? $request->bayar : null,
                'kembalian' => 0,
                'waktu_transaksi' => now(),
            ]);

            // ================= PAKET CUCI =================
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

            // ================= TOTAL =================
            $total = $subtotalPaket + $totalTambahan;

            // ================= MEMBER / PROMO =================
            $kodeMember = $request->kode_member;
            $isMember = !empty($kodeMember);

            if ($isMember) {
                $jumlahTransaksi = Transaksi::where('kode_member', $kodeMember)->count() + 1;
                $gratis = ($jumlahTransaksi % 5 === 0);
            } else {
                $jumlahTransaksi = Transaksi::whereNull('kode_member')
                    ->where('no_polisi', $request->no_plat)
                    ->count() + 1;
                $gratis = ($jumlahTransaksi % 10 === 0);
            }

            // ================= DISKON =================
            $diskon = $gratis ? $total : 0;
            $totalFinal = max(0, $total - $diskon);

            // ================= PEMBAYARAN =================
            $bayar = (int) $request->bayar;
            $kembalian = $request->metode_pembayaran === 'cash'
                ? max(0, $bayar - $totalFinal)
                : null;

            // ================= UPDATE FINAL =================
            $transaksi->update([
                'total_harga' => $total,
                'diskon' => $diskon,
                'total_harga_final' => $totalFinal,
                'bayar' => $request->metode_pembayaran === 'cash' ? $bayar : null,
                'kembalian' => $kembalian,
            ]);
        });

        // ================= QRIS =================
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

    // ================= STRUK =================
    public function struk($id)
    {
        $transaksi = Transaksi::with([
            'kendaraan',
            'items.paketCuci',
            'items.paketHarga',
            'tambahans.paketTambahan',
            'user'
        ])->findOrFail($id);

        return view('transaksi.struk', compact('transaksi'));
    }

    // ================= CARI MEMBER =================
    public function cariMember(Request $request)
    {
        $q = $request->q;

        if (!$q || strlen($q) < 2) {
            return response()->json([]);
        }

        $pelanggan = Kendaraan::with('member')
            ->where('nama_pemilik', 'like', "%$q%")
            ->get()
            ->map(function ($k) {
                return [
                    'nama_pemilik' => $k->nama_pemilik,
                    'kode_member' => optional($k->member)->kode_member,
                    'telepon' => $k->telepon,
                    'kendaraan' => [[
                        'no_plat' => $k->no_plat,
                        'merk' => $k->merk,
                        'tipe_kendaraan_id' => $k->tipe_kendaraan_id,
                    ]]
                ];
            });

        return response()->json($pelanggan->take(10)->values());
    }

    // ================= PAKET BY TIPE =================
    public function paketByTipe($tipeId)
    {
        return PaketHarga::with('paketCuci')
            ->where('tipe_kendaraan_id', $tipeId)
            ->get();
    }

    
}
