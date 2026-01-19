@extends('layouts.admin')

@section('title', 'Tambah Paket Cuci')

@section('content')
<div class="container mt-4" style="max-width: 600px">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Tambah Paket Cuci</h4>
    </div>

    {{-- ERROR VALIDASI --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.paketcuci.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Paket</label>
                    <input type="text" name="nama_paket" class="form-control" value="{{ old('nama_paket') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi') }}</textarea>
                </div>

                {{-- Tombol Kembali & Simpan --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.paketcuci.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                    <button class="btn btn-success">Simpan</button>
                </div>

            </form>
        </div>
    </div>

</div>

@endsection
