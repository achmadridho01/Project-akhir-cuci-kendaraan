<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kendaraan;
use App\Models\Member;
use SimpleSoftwareIO\QrCode\Facades\QrCode;




class MemberController extends Controller
{
    public function index()
    {
        $members = Member::withCount('kendaraan')->get();
        return view('admin.member.index', compact('members'));
    }

    

   public function show($id)
{
    $member = Member::with('kendaraan')->findOrFail($id);

    return view('admin.member.show', compact('member'));
}

  public function card($id)
{
    $member = Member::with(['kendaraan.tipeKendaraan'])->findOrFail($id);
    return view('admin.member.card', compact('member'));
}

public function create()
{
    $kendaraans = Kendaraan::whereNull('member_id')->get();
    return view('admin.member.create', compact('kendaraans'));
}


public function store(Request $request)
{
    $request->validate([
        'nama_member' => 'required',
        'telepon' => 'required',
        'kendaraan_id' => 'required'
    ]);

    $member = Member::create([
        'kode_member' => 'MBR'.date('ymd').rand(100,999),
        'nama_member' => $request->nama_member,
        'telepon' => $request->telepon,
    ]);

    Kendaraan::where('id', $request->kendaraan_id)
        ->update(['member_id' => $member->id]);

    return redirect()->route('member.index')->with('success','Member berhasil dibuat dan kendaraan terhubung');
}

public function destroy($id)
{
    $member = Member::findOrFail($id);

    // Lepaskan semua kendaraan dari member
    $member->kendaraan()->update(['member_id' => null]);

    $member->delete();

    return redirect()->route('member.index')
        ->with('success', 'Member berhasil dihapus');
}


public function edit($id)
{
    $member = Member::findOrFail($id);
    return view('admin.member.edit', compact('member'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama_member' => 'required',
        'telepon' => 'required'
    ]);

    $member = Member::findOrFail($id);

    $member->update([
        'nama_member' => $request->nama_member,
        'telepon' => $request->telepon,
    ]);

    return redirect()
        ->route('member.index')
        ->with('success', 'Data member berhasil diupdate');
}

public function print($id)
{
    $member = Member::findOrFail($id);
    return view('admin.member.print', compact('member'));
}


}

