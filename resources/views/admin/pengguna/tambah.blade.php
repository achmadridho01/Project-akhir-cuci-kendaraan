@extends('layouts.admin')

@section('content')
<div class="container mt-4" style="max-width: 600px">

    <h4 class="mb-4">Tambah Pengguna</h4>

    {{-- ERROR VALIDATION --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.pengguna.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input
                type="text"
                name="name"
                class="form-control"
                value="{{ old('name') }}"
                required
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input
                type="email"
                name="email"
                class="form-control"
                value="{{ old('email') }}"
                required
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Password (min 6 karakter)</label>
            <input
                type="password"
                name="password"
                class="form-control"
                required
            >
        </div>

        <div class="mb-4">
            <label class="form-label">Role</label>
            <select name="role" class="form-select" required>
                <option value="">-- Pilih Role --</option>
                <option value="admin">ADMIN</option>
                <option value="kasir">KASIR</option>
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.pengguna.index') }}" class="btn btn-secondary">
                Kembali
            </a>
            <button class="btn btn-success">
                Simpan
            </button>
        </div>
    </form>

</div>
@endsection
