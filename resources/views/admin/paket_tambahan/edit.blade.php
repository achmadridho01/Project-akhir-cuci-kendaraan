@extends('layouts.admin')
@section('title', 'Edit Paket Tambahan')

@section('content')
<div class="container mt-4" style="max-width:600px; margin:auto;">

    <div class="text-center mb-3">
        <h4>Edit Paket Tambahan</h4>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">

            <form method="POST" action="{{ route('admin.pakettambahan.update', $data->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Tambahan</label>
                    <input type="text"
                           name="nama_tambahan"
                           class="form-control"
                           value="{{ old('nama_tambahan', $data->nama_tambahan) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi"
                              class="form-control"
                              rows="3">{{ old('deskripsi', $data->deskripsi) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="number"
                           name="harga"
                           class="form-control"
                           value="{{ old('harga', $data->harga) }}"
                           required>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.pakettambahan.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                    <button class="btn btn-success">
                        Update
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
