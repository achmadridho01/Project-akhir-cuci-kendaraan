<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaketHarga;
use App\Models\PaketCuci;
use App\Models\TipeKendaraan;

class PaketHargaController extends Controller
{
    // Tampilkan semua paket harga
    public function index()
    {
        $harga = PaketHarga::with(['paketCuci', 'tipeKendaraan'])->get();
        return view('admin.paketharga.index', compact('harga'));
    }

    // Form tambah harga
    public function create()
    {
        $paket = PaketCuci::all();
        $tipe  = TipeKendaraan::all();

        return view('admin.paketharga.tambah', compact('paket', 'tipe'));
    }

    // Simpan harga
    public function store(Request $request)
    {
        $request->validate([
            'paket_cuci_id'     => 'required',
            'tipe_kendaraan_id' => 'required',
            'harga'             => 'required|numeric'
        ]);

        PaketHarga::create($request->all());

        return redirect()->route('admin.paketharga.index')
            ->with('success', 'Harga paket berhasil ditambahkan');
    }

    // Form edit
    public function edit($id)
    {
        $data  = PaketHarga::findOrFail($id);
        $paket = PaketCuci::all();
        $tipe  = TipeKendaraan::all();

        return view('admin.paketharga.edit', compact('data', 'paket', 'tipe'));
    }

    // Update harga
    public function update(Request $request, $id)
    {
        $request->validate([
            'paket_cuci_id'     => 'required',
            'tipe_kendaraan_id' => 'required',
            'harga'             => 'required|numeric'
        ]);

        PaketHarga::findOrFail($id)->update($request->all());

        return redirect()->route('admin.paketharga.index')
            ->with('success', 'Harga paket berhasil diupdate');
    }

    // Hapus harga
    public function destroy($id)
    {
        PaketHarga::findOrFail($id)->delete();

        return back()->with('success', 'Harga paket dihapus');
    }
}
