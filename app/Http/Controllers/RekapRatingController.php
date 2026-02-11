<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RekapRatingController extends Controller
{
    public function index()
    {
        abort_if(Auth::user()->role !== 'admin', 403);

        $data = DB::table('ratings')
            ->join('users', 'ratings.kasir_id', '=', 'users.id') // kasir_id
            ->select(
                'users.name as nama',
                DB::raw('COUNT(ratings.id) as jumlah'),
                DB::raw('AVG(ratings.nilai_rating) as rata_rata')
            )
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('rata_rata')
            ->get();

        return view('admin.rekap_rating', compact('data'));
    }
}
