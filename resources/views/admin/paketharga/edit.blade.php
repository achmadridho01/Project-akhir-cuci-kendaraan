@extends('layouts.admin')

@section('title', 'Edit Harga Paket')

@section('content')
<div class="container mt-4" style="max-width: 600px">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Edit Harga Paket</h4>
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
            <form action="{{ route('admin.paketharga.update', $data->id) }}" method="POST">
                @csrf
                @method('POST')

                <div class="mb-3">
                    <label class="form-label">Paket Cuci</label>
                    <select name="paket_cuci_id" class="form-select" required>
                        @foreach($paket as $p)
                            <option value="{{ $p->id }}" {{ $data->paket_cuci_id == $p->id ? 'selected' : '' }}>
                                {{ $p->nama_paket }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tipe Kendaraan</label>
                    <select name="tipe_kendaraan_id" class="form-select" required>
                        @foreach($tipe as $t)
                            <option value="{{ $t->id }}" {{ $data->tipe_kendaraan_id == $t->id ? 'selected' : '' }}>
                                {{ $t->nama_tipe }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="number" name="harga" value="{{ old('harga', $data->harga) }}" class="form-control" required>
                </div>

                {{-- Tombol Kembali & Update --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.paketharga.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                    <button class="btn btn-success">Update</button>
                </div>

            </form>
        </div>
    </div>

</div>

@endsection
