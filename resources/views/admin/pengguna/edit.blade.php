@extends('layouts.admin')

@section('content')
<div class="container mt-4" style="max-width: 600px">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Edit Pengguna</h4>
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

            <form method="POST"
                  action="{{ route('admin.pengguna.update', $user->id) }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ old('name', $user->name) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Password <small class="text-muted">(opsional)</small>
                    </label>
                    <input type="password"
                           name="password"
                           class="form-control">
                    <small class="text-muted">
                        Kosongkan jika tidak ingin mengganti password
                    </small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="admin"
                            {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>
                            ADMIN
                        </option>
                        <option value="kasir"
                            {{ old('role', $user->role) === 'kasir' ? 'selected' : '' }}>
                            KASIR
                        </option>
                    </select>
                </div>

               <div class="d-flex justify-content-between mt-4">
    <a href="{{ route('admin.pengguna.index') }}" class="btn btn-secondary">
        Batal
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
