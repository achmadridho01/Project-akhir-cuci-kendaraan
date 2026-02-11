<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class RatingController extends Controller
{
   public function create($id)
{
    $transaksi = Transaksi::findOrFail($id);

    // cegah rating ganda
    if (Rating::where('transaksi_id', $id)->where('kasir_id', auth()->id())->exists()) {
        return redirect()->route('transaksi.struk', $id)
                         ->with('info', 'Rating sudah diberikan');
    }

    return view('rating.create', compact('transaksi'));
}

public function store(Request $request, $id)
{
    $request->validate([
        'nilai_rating' => 'required|integer|min:1|max:5'
    ]);

    $transaksi = Transaksi::findOrFail($id);

    Rating::create([
        'transaksi_id' => $transaksi->id,
        'kasir_id'     => auth()->id(), // kasir yang login
        'nilai_rating' => $request->nilai_rating
    ]);

    return redirect()->route('transaksi.struk', $transaksi->id)
                     ->with('success', 'Terima kasih atas penilaian Anda 🙏');
}

}