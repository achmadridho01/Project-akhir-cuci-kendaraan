@extends('layouts.admin')

@section('title', 'Kartu Member Premium')

@section('content')
<div class="d-flex flex-column align-items-center mt-5">

    {{-- Tombol Kembali & Cetak --}}
    <div class="mb-4 text-center">
        <a href="{{ route('member.index') }}" class="btn btn-secondary">
            Kembali
        </a>
        <a href="{{ route('member.print', $member->id) }}" target="_blank" class="btn btn-success ms-2">
            🖨️ Cetak Kartu
        </a>
    </div>

    {{-- Card Member Premium --}}
    <div class="card shadow-lg" style="width: 500px; border-radius: 20px; overflow: hidden; font-family: 'Arial', sans-serif;">

        {{-- Header --}}
        <div style="height: 80px; background: linear-gradient(135deg, #007bff, #00c6ff); display:flex; align-items:center; justify-content:center; position: relative;">
            {{-- Logo --}}
            <img src="{{ asset('storage/logo/logocuci.png') }}" alt="Logo" style="height:60px; width:auto; border-radius:10px; border:2px solid #fff; position:absolute; left:15px; top:10px; box-shadow: 0 2px 6px rgba(0,0,0,0.3);">
            {{-- Judul --}}
            <h4 class="text-white fw-bold mb-0" style="z-index:1;">KARTU MEMBER</h4>
        </div>

        {{-- Body Member + QR --}}
        <div style="display:flex; padding:20px; background:#f8f9fa; gap:20px;">

            {{-- Info Member --}}
            <div style="flex:1; display:flex; flex-direction:column; justify-content: space-around;">
                <div style="display:flex; justify-content: space-between; align-items:center; margin-bottom:10px;">
                    <strong>Kode Member</strong>
                    <div style="background:#fff; padding:5px 15px; border-radius:8px; box-shadow:0 1px 3px rgba(0,0,0,0.2);">{{ $member->kode_member }}</div>
                </div>
                <div style="display:flex; justify-content: space-between; align-items:center; margin-bottom:10px;">
                    <strong>Nama Member</strong>
                    <div style="background:#fff; padding:5px 15px; border-radius:8px; box-shadow:0 1px 3px rgba(0,0,0,0.2);">{{ $member->nama_member }}</div>
                </div>
                <div style="display:flex; justify-content: space-between; align-items:center; margin-bottom:10px;">
                    <strong>No HP</strong>
                    <div style="background:#fff; padding:5px 15px; border-radius:8px; box-shadow:0 1px 3px rgba(0,0,0,0.2);">{{ $member->telepon }}</div>
                </div>
                {{-- Catatan --}}
                <small style="color:#6c757d;">Terima kasih telah menjadi member Wash The Vehicle</small>
            </div>

            {{-- QR CODE OTOMATIS (tanpa garis kuning) --}}
            <div>
                @php
                    $qr = QrCode::size(80)->generate($member->kode_member);
                @endphp
                <div>{!! $qr !!}</div>
            </div>
        </div>
    </div>
</div>
@endsection
