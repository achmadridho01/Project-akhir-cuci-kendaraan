<?php

namespace App\Http\Controllers;

use App\Models\PaketTambahan;
use Illuminate\Http\Request;

class PaketTambahanController extends Controller
{
    public function index()
    {
        $data = PaketTambahan::all();
        return view('admin.paket_tambahan.index', compact('data'));
    }

    public function create()
    {
        return view('admin.paket_tambahan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tambahan' => 'required|string',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
        ]);

        PaketTambahan::create($request->all());
        return redirect()->route('admin.pakettambahan.index')->with('success', 'Paket tambahan berhasil dibuat');
    }

    public function edit($id)
    {
        $data = PaketTambahan::findOrFail($id);
        return view('admin.paket_tambahan.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_tambahan' => 'required|string',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
        ]);

        $paket = PaketTambahan::findOrFail($id);
        $paket->update($request->all());
        return redirect()->route('admin.pakettambahan.index')->with('success', 'Paket tambahan berhasil diupdate');
    }

    public function destroy($id)
    {
        $paket = PaketTambahan::findOrFail($id);
        $paket->delete();
        return redirect()->route('admin.pakettambahan.index')->with('success', 'Paket tambahan berhasil dihapus');
    }
}
