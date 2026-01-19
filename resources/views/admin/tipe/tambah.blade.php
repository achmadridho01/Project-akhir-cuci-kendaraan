@extends('layouts.admin')

@section('title', 'Tambah Tipe Kendaraan')

@section('content')
<h3>Tambah Tipe Kendaraan</h3>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('admin.tipe.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Nama Tipe</label>
        <input type="text" name="nama_tipe" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.tipe.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
