@extends('layouts.admin')

@section('title', 'Edit Kendaraan')

@section('content')
<div class="container mt-4" style="max-width: 600px">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Edit Kendaraan</h4>
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
            <form method="POST" action="{{ route('kendaraan.update', $kendaraan->id) }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Pemilik</label>
                    <input type="text" name="nama_pemilik" value="{{ old('nama_pemilik', $kendaraan->nama_pemilik) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">No Plat</label>
                    <input type="text" name="no_plat" value="{{ old('no_plat', $kendaraan->no_plat) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tipe Kendaraan</label>
                    <select name="tipe_kendaraan_id" class="form-select" required>
                        @foreach($tipe as $t)
                            <option value="{{ $t->id }}" {{ old('tipe_kendaraan_id', $kendaraan->tipe_kendaraan_id) == $t->id ? 'selected' : '' }}>
                                {{ $t->nama_tipe }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Merk</label>
                    <input type="text" name="merk" value="{{ old('merk', $kendaraan->merk) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Telepon</label>
                    <input type="text" name="telepon" value="{{ old('telepon', $kendaraan->telepon) }}" class="form-control">
                </div>

                {{-- Tombol Kembali & Update --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('kendaraan.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                    <button class="btn btn-success">Update</button>
                </div>

            </form>
        </div>
    </div>

</div>

@endsection
