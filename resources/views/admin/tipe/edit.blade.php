@extends('layouts.admin')

@section('title', 'Edit Tipe Kendaraan')

@section('content')
<div class="container mt-4" style="max-width: 600px">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Edit Tipe Kendaraan</h4>
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
            <form method="POST" action="{{ route('admin.tipe.update', $tipe->id) }}">
                @csrf
                @method('POST')

                <div class="mb-3">
                    <label class="form-label">Nama Tipe</label>
                    <input type="text" name="nama_tipe" class="form-control"
                           value="{{ old('nama_tipe', $tipe->nama_tipe) }}" required>
                </div>

                {{-- Tombol Kembali & Update --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.tipe.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                    <button class="btn btn-success">Update</button>
                </div>

            </form>
        </div>
    </div>

</div>

@endsection
