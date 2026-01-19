@extends('layouts.admin')

@section('title', 'Tambah Kendaraan')

@section('content')
<div class="container mt-4" style="max-width: 600px">

    <h4 class="mb-4">Tambah Kendaraan</h4>

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
            <form method="POST" action="{{ route('kendaraan.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Pemilik</label>
                    <input type="text" name="nama_pemilik" class="form-control" value="{{ old('nama_pemilik') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">No Plat</label>
                    <input type="text" name="no_plat" class="form-control" value="{{ old('no_plat') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tipe Kendaraan</label>
                    <select name="tipe_kendaraan_id" class="form-select" required>
                        <option value="">- Pilih -</option>
                        @foreach($tipe as $t)
                            <option value="{{ $t->id }}" {{ old('tipe_kendaraan_id') == $t->id ? 'selected' : '' }}>
                                {{ $t->nama_tipe }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Merk</label>
                    <input type="text" name="merk" class="form-control" value="{{ old('merk') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Telepon</label>
                    <input type="text" name="telepon" class="form-control" value="{{ old('telepon') }}">
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('kendaraan.index') }}" class="btn btn-secondary">Kembali</a>
                    <button class="btn btn-success">Simpan</button>
                </div>

            </form>
        </div>
    </div>

</div>

@endsection
