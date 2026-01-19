@extends('layouts.admin')

@section('content')
<div class="container text-center mt-5">
    {{-- QRIS --}}
    <div class="my-4">
        <img src="{{ asset('storage/logo/qris.png') }}" alt="QRIS Wash The Vehicle" style="width:400px; max-width:300%;">
    </div>

    {{-- Tombol lanjut ke struk --}}
    <div class="mt-3">
        <a href="{{ route('transaksi.struk', $transaksi->id) }}" class="btn btn-success me-2">
            Lanjut ke Struk
        </a>

        {{-- Tombol transaksi baru --}}
        <a href="{{ route('transaksi.create') }}" class="btn btn-primary">
            Transaksi Baru
        </a>
    </div>

</div>
@endsection
