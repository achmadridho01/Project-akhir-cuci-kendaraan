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

            // SIMPAN KENDARAAN
            $kendaraan = Kendaraan::firstOrCreate(
                ['no_plat' => $request->no_plat],
                [
                    'nama_pemilik' => $request->nama_pelanggan,
                    'telepon' => $request->telepon,
                    'merk' => $request->merk,
                    'tipe_kendaraan_id' => $request->tipe_kendaraan_id,
                ]
            );

            // SIMPAN TRANSAKSI
            $transaksi = Transaksi::create([
                'user_id' => auth()->id(),
                'kendaraan_id' => $kendaraan->id,
                'nama_pelanggan' => $request->nama_pelanggan,
                'no_polisi' => $request->no_plat,
                'tipe_kendaraan_id' => $request->tipe_kendaraan_id,
                'total_harga' => 0,
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
    'harga' => $pt->harga,          // 🔥 PENTING
    'subtotal' => $pt->harga * 1,   // optional tapi rapi
]);


                    $totalTambahan += $pt->harga;
                }
            }

            // ================= TOTAL =================
            $total = $subtotalPaket + $totalTambahan;
            $bayar = (int) $request->bayar;
            $kembalian = max(0, $bayar - $total);

            $transaksi->update([
                'total_harga' => $total,
                'bayar' => $request->metode_pembayaran === 'cash' ? $bayar : null,
                'kembalian' => $request->metode_pembayaran === 'cash' ? $kembalian : null,
                'metode_pembayaran' => $request->metode_pembayaran,
            ]);
        });

        // QRIS
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
            'items.paketCuci',
            'items.paketHarga',
            'tambahans.paketTambahan',
            'user'
        ])->findOrFail($id);

        return view('transaksi.struk', compact('transaksi'));
    }

    public function cariMember(Request $request)
    {
        $q = $request->q;

        $members = Member::with('kendaraan')
            ->where('nama_member', 'like', "%$q%")
            ->orWhere('kode_member', 'like', "%$q%")
            ->get();

        return response()->json(
            $members->map(function ($m) {
                return [
                    'id' => $m->id,
                    'kode_member' => $m->kode_member,
                    'nama_pemilik' => $m->nama_member,
                    'telepon' => $m->telepon,
                    'kendaraan' => $m->kendaraan->map(function ($k) {
                        return [
                            'id' => $k->id,
                            'no_plat' => $k->no_plat,
                            'merk' => $k->merk,
                            'model' => $k->model,
                            'tipe_kendaraan_id' => $k->tipe_kendaraan_id
                        ];
                    })->values()
                ];
            })
        );
    }

    public function paketByTipe($tipeId)
    {
        return PaketHarga::with('paketCuci')
            ->where('tipe_kendaraan_id', $tipeId)
            ->get();
    }

     

}
