<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\TipeKendaraan;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraan = Kendaraan::with(['tipeKendaraan', 'member'])->get();
        return view('admin.kendaraan.index', compact('kendaraan'));
    }

    public function create()
    {
        $tipe = TipeKendaraan::all();
        return view('admin.kendaraan.tambah', compact('tipe'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemilik'       => 'required|string|max:100',
            'telepon'            => 'required|string|max:20',
            'no_plat'            => 'required|unique:kendaraan,no_plat',
            'merk'               => 'required|string|max:50',
            'tipe_kendaraan_id'  => 'required|exists:tipe_kendaraan,id',
        ]);

        /**
         * 1️⃣ Cari atau buat MEMBER berdasarkan telepon
         */
        $member = Member::where('telepon', $request->telepon)->first();

        if (!$member) {
            $member = Member::create([
                'kode_member' => 'MBR-' . strtoupper(Str::random(6)),
                'nama_member'        => $request->nama_pemilik,
                'telepon'     => $request->telepon,
            ]);
        }

        /**
         * 2️⃣ Simpan kendaraan ke MEMBER
         */
        Kendaraan::create([
            'member_id'          => $member->id,
            'nama_pemilik'       => $request->nama_pemilik,
            'telepon'            => $request->telepon,
            'no_plat'            => $request->no_plat,
            'merk'               => $request->merk,
            'tipe_kendaraan_id'  => $request->tipe_kendaraan_id,
        ]);

        return redirect()
            ->route('kendaraan.index')
            ->with('success', 'Kendaraan berhasil ditambahkan & Member otomatis dibuat');
    }

    public function edit($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $tipe = TipeKendaraan::all();

        return view('admin.kendaraan.edit', compact('kendaraan', 'tipe'));
    }

    public function update(Request $request, $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        $request->validate([
            'nama_pemilik'       => 'required|string|max:100',
            'telepon'            => 'required|string|max:20',
            'no_plat'            => 'required|unique:kendaraan,no_plat,' . $id,
            'merk'               => 'required|string|max:50',
            'tipe_kendaraan_id'  => 'required|exists:tipe_kendaraan,id',
        ]);

        $kendaraan->update([
            'nama_pemilik'       => $request->nama_pemilik,
            'telepon'            => $request->telepon,
            'no_plat'            => $request->no_plat,
            'merk'               => $request->merk,
            'tipe_kendaraan_id'  => $request->tipe_kendaraan_id,
        ]);

        return redirect()
            ->route('kendaraan.index')
            ->with('success', 'Kendaraan berhasil diupdate');
    }

    public function destroy($id)
    {
        Kendaraan::destroy($id);

        return redirect()
            ->route('kendaraan.index')
            ->with('success', 'Kendaraan berhasil dihapus');
    }

  public function searchNama(Request $request)
{
    $q = $request->q;

    return Kendaraan::with('tipeKendaraan')
        ->where('nama_pemilik', 'like', "%$q%")
        ->whereNull('member_id')   // hanya kendaraan yg belum jadi member
        ->limit(10)
        ->get()
        ->map(function($k){
            return [
                'id' => $k->id,
                'nama' => $k->nama_pemilik,
                'telepon' => $k->telepon,
                'no_plat' => $k->no_plat,
                'tipe' => $k->tipeKendaraan->nama_tipe ?? '-'
            ];
        });
}


public function detail($id)
{
    $k = Kendaraan::with('tipeKendaraan')->findOrFail($id);

    return [
        'id' => $k->id,
        'nama' => $k->nama_pemilik,
        'telepon' => $k->telepon,
        'no_plat' => $k->no_plat,
        'tipe' => $k->tipeKendaraan->nama_tipe ?? '-'
    ];
}


}
