@extends('layouts.admin')

@section('title', 'Paket Cuci')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Paket Cuci</h4>
        <a href="{{ route('admin.paketcuci.create') }}" class="btn btn-primary">
             Tambah Paket
        </a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="50">#</th>
                        <th>Nama Paket</th>
                        <th>Deskripsi</th>
                        <th width="160">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($paket as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->nama_paket }}</td>
                        <td>{{ $p->deskripsi }}</td>
                        <td>
                            <a href="{{ route('admin.paketcuci.edit', $p->id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form method="POST" action="{{ route('admin.paketcuci.destroy', $p->id) }}" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm btn-delete">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">
                            Data paket cuci belum ada
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

{{-- POP-UP NOTIFIKASI SUKSES --}}
<div id="notif-success" style="
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #28a745;
    color: white;
    padding: 15px 30px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    z-index: 9999;
    font-weight: 500;
    text-align: center;
    opacity: 0;
    transition: opacity 0.5s ease-in-out;
"></div>

{{-- POP-UP KONFIRMASI HAPUS --}}
<div id="confirm-delete" style="
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #f8f9fa;
    color: #212529;
    padding: 20px 30px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    z-index: 10000;
    display: none;
    width: 300px;
    text-align: center;
">
    <p style="margin-bottom: 20px;">Yakin ingin dihapus?</p>
    <div class="d-flex justify-content-center gap-2">
        <button id="confirm-yes" class="btn btn-danger">Ya</button>
        <button id="confirm-no" class="btn btn-secondary">Batal</button>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Konfirmasi hapus
    const deleteButtons = document.querySelectorAll('.btn-delete');
    const confirmPopup = document.getElementById('confirm-delete');
    let formToSubmit = null;

    deleteButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            formToSubmit = btn.closest('form');
            confirmPopup.style.display = 'block';
        });
    });

    document.getElementById('confirm-no').addEventListener('click', function() {
        confirmPopup.style.display = 'none';
        formToSubmit = null;
    });

    document.getElementById('confirm-yes').addEventListener('click', function() {
        confirmPopup.style.display = 'none';
        if(formToSubmit) formToSubmit.submit();
    });

    // Notifikasi sukses
    const notif = document.getElementById('notif-success');
    @if(session('success'))
        notif.textContent = "{{ session('success') }}";
        notif.style.opacity = 1;
        setTimeout(() => {
            notif.style.opacity = 0;
            setTimeout(() => notif.textContent = "", 500);
        }, 2500);
    @endif
});
</script>
@endsection
