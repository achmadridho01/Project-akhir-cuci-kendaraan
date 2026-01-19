<?php

namespace App\Http\Controllers;

use App\Models\PaketCuci;
use Illuminate\Http\Request;

class PaketCuciController extends Controller
{
    public function index()
    {
        $paket = PaketCuci::all();
        return view('admin.paketcuci.index', compact('paket'));
    }

    public function create()
    {
        return view('admin.paketcuci.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_paket' => 'required|unique:paket_cuci,nama_paket',
        ]);

        PaketCuci::create([
            'nama_paket' => $request->nama_paket,
            'deskripsi'  => $request->deskripsi,
        ]);

        return redirect()->route('admin.paketcuci.index')
            ->with('success', 'Paket cuci berhasil ditambahkan');
    }

    public function edit($id)
    {
        $paket = PaketCuci::findOrFail($id);
        return view('admin.paketcuci.edit', compact('paket'));
    }

    public function update(Request $request, $id)
    {
        $paket = PaketCuci::findOrFail($id);

        $paket->update([
            'nama_paket' => $request->nama_paket,
            'deskripsi'  => $request->deskripsi,
        ]);

        return redirect()->route('admin.paketcuci.index')
            ->with('success', 'Paket cuci berhasil diupdate');
    }

    public function destroy($id)
    {
        PaketCuci::destroy($id);

        return redirect()->route('admin.paketcuci.index')
            ->with('success', 'Paket cuci berhasil dihapus');
    }
}
