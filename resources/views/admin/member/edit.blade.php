@extends('layouts.admin')

@section('title', 'Edit Member')

@section('content')
<div class="container mt-4">

<a href="{{ route('member.index') }}" class="btn btn-secondary mb-3"> Kembali</a>

<div class="card shadow">
    <div class="card-header bg-warning text-dark">
        <strong>Edit Data Member</strong>
    </div>

    <div class="card-body">
        <form action="{{ route('member.update', $member->id) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Kode Member</label>
                <input type="text" class="form-control" value="{{ $member->kode_member }}" readonly>
            </div>

            <div class="mb-3">
                <label>Nama Member</label>
                <input type="text" name="nama_member" class="form-control" value="{{ $member->nama_member }}" required>
            </div>

            <div class="mb-3">
                <label>No HP</label>
                <input type="text" name="telepon" class="form-control" value="{{ $member->telepon }}" required>
            </div>

            <button class="btn btn-success">Simpan Perubahan</button>
        </form>
    </div>
</div>

</div>
@endsection
