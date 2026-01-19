@extends('layouts.admin')
@section('title', 'Paket Tambahan')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Paket Tambahan</h4>
        <a href="{{ route('admin.pakettambahan.create') }}" class="btn btn-primary">Tambah Paket</a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="50">#</th>
                        <th>Nama Tambahan</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th width="160">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $t)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $t->nama_tambahan }}</td>
                        <td>{{ $t->deskripsi }}</td>
                        <td>Rp {{ number_format($t->harga,0,',','.') }}</td>
                        <td>
                            <a href="{{ route('admin.pakettambahan.edit', $t->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form method="POST" action="{{ route('admin.pakettambahan.destroy', $t->id) }}" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm btn-delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Data paket tambahan belum ada</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.btn-delete');
    const confirmPopup = document.createElement('div');
    confirmPopup.style.cssText = 'position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background:#f8f9fa; padding:20px 30px; border-radius:10px; box-shadow:0 4px 12px rgba(0,0,0,0.3); z-index:10000; display:none; width:300px; text-align:center;';
    confirmPopup.innerHTML = '<p style="margin-bottom:20px;">Yakin ingin dihapus?</p><div class="d-flex justify-content-center gap-2"><button id="confirm-yes" class="btn btn-danger">Ya</button><button id="confirm-no" class="btn btn-secondary">Batal</button></div>';
    document.body.appendChild(confirmPopup);

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
    @if(session('success'))
        const notif = document.createElement('div');
        notif.textContent = "{{ session('success') }}";
        notif.style.cssText = 'position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background:#28a745; color:white; padding:15px 30px; border-radius:8px; box-shadow:0 4px 12px rgba(0,0,0,0.3); z-index:9999; font-weight:500; text-align:center; opacity:1; transition: opacity 0.5s;';
        document.body.appendChild(notif);
        setTimeout(() => { notif.style.opacity = 0; setTimeout(()=>notif.remove(),500); }, 2500);
    @endif
});
</script>
@endsection
