@extends('layouts.admin')

@section('title', 'Data Kendaraan')

@section('content')
<div class="container mt-4">

    {{-- NOTIF SUKSES --}}
    @if(session('success'))
    <div id="notif-success" style="
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #28a745;
        color: white;
        padding: 18px 30px;
        border-radius: 10px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.3);
        z-index: 9999;
        font-weight: 600;
        font-size: 16px;
        text-align: center;
        opacity: 0;
        transition: opacity 0.4s ease-in-out;
    ">
        {{ session('success') }}
    </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Kendaraan</h4>
        <a href="{{ route('kendaraan.create') }}" class="btn btn-primary">
            Tambah Kendaraan
        </a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Pemilik</th>
                        <th>No Plat</th>
                        <th>Tipe</th>
                        <th>Merk</th>
                        <th>Telepon</th>
                        <th width="160">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kendaraan as $k)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $k->nama_pemilik }}</td>
                        <td>{{ $k->no_plat }}</td>
                        <td>{{ $k->tipeKendaraan->nama_tipe ?? '-' }}</td>
                        <td>{{ $k->merk }}</td>
                        <td>{{ $k->telepon }}</td>
                        <td>
                            <a href="{{ route('kendaraan.edit', $k->id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form method="POST"
                                  action="{{ route('kendaraan.destroy', $k->id) }}"
                                  class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                        class="btn btn-danger btn-sm btn-delete">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            Data kendaraan belum ada
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- POPUP KONFIRMASI HAPUS --}}
<div id="confirm-delete" style="
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #fff;
    padding: 22px 30px;
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.3);
    z-index: 10000;
    display: none;
    width: 320px;
    text-align: center;
">
    <p style="font-weight:600; margin-bottom:20px;">
        Yakin ingin menghapus kendaraan ini?
    </p>
    <div class="d-flex justify-content-center gap-2">
        <button id="btn-yes" class="btn btn-danger">Ya</button>
        <button id="btn-no" class="btn btn-secondary">Batal</button>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ===== NOTIF SUKSES ===== */
    const notif = document.getElementById('notif-success');
    if (notif) {
        notif.style.opacity = 1;
        setTimeout(() => {
            notif.style.opacity = 0;
            setTimeout(() => notif.remove(), 400);
        }, 2200);
    }

    /* ===== KONFIRMASI HAPUS ===== */
    let formTarget = null;
    const confirmBox = document.getElementById('confirm-delete');

    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', function () {
            formTarget = this.closest('form');
            confirmBox.style.display = 'block';
        });
    });

    document.getElementById('btn-no').addEventListener('click', function () {
        confirmBox.style.display = 'none';
        formTarget = null;
    });

    document.getElementById('btn-yes').addEventListener('click', function () {
        if (formTarget) {
            formTarget.submit();
        }
    });
});
</script>
@endsection
