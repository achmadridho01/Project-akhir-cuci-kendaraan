@extends('layouts.admin')

@section('title', 'Detail Member')

@section('content')
<div class="container mt-4">

    <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">
         Kembali
    </a>

    <h4 class="mb-3">Detail Member</h4>

    <div class="card mb-4">
        <div class="card-body">
             <p><strong>Kode Member :</strong> {{ $member->kode_member }}</p>
            <p><strong>Nama :</strong> {{ $member->nama_member }}</p>
            <p><strong>Telepon :</strong> {{ $member->telepon }}</p>
            <p><strong>Total Kendaraan :</strong> {{ $member->kendaraan->count() }}</p>
        </div>
    </div>

    <h5>Daftar Kendaraan</h5>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-bordered">
    <thead class="table-light">
        <tr>
            <th>No</th>
            <th>No Plat</th>
            <th>Tipe Kendaraan</th>
            <th>Merk Kendaraan</th>
        </tr>
    </thead>
    <tbody>
        @forelse($member->kendaraan as $k)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $k->no_plat }}</td>
            <td>{{ $k->tipeKendaraan->nama_tipe ?? '-' }}</td>
            <td>{{ $k->merk ?? '-' }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center text-muted">
                Belum ada kendaraan
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

        </div>
    </div>

</div>
@endsection
