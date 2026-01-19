<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipeKendaraan;

class TipeKendaraanController extends Controller
{
    // Menampilkan semua tipe kendaraan
    public function index()
    {
        $tipe = TipeKendaraan::all();
        return view('admin.tipe.index', compact('tipe'));
    }

    // Form tambah tipe kendaraan
    public function create()
    {
        return view('admin.tipe.tambah');
    }

    // Simpan tipe kendaraan baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_tipe' => 'required|unique:tipe_kendaraan,nama_tipe'
        ]);

        TipeKendaraan::create([
            'nama_tipe' => $request->nama_tipe
        ]);

        return redirect()->route('admin.tipe.index')
                         ->with('success', 'Tipe kendaraan berhasil ditambahkan.');
    }

    // Form edit tipe kendaraan
    public function edit($id)
    {
        $tipe = TipeKendaraan::findOrFail($id);
        return view('admin.tipe.edit', compact('tipe'));
    }

    // Update tipe kendaraan
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_tipe' => 'required|unique:tipe_kendaraan,nama_tipe,' . $id
        ]);

        $tipe = TipeKendaraan::findOrFail($id);
        $tipe->update([
            'nama_tipe' => $request->nama_tipe
        ]);

        return redirect()->route('admin.tipe.index')
                         ->with('success', 'Tipe kendaraan berhasil diupdate.');
    }

    // Hapus tipe kendaraan
    public function destroy($id)
    {
        $tipe = TipeKendaraan::findOrFail($id);

        try {
            $tipe->delete();
            return redirect()->route('admin.tipe.index')
                             ->with('success', 'Tipe kendaraan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.tipe.index')
                             ->with('error', 'Tipe kendaraan gagal dihapus.');
        }
    }
}
