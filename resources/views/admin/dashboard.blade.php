@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')

<style>
.card {
    border-radius: 16px;
    transition: all 0.3s ease;
}
.card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.15);
}

.border-primary { border-color: #4e73df !important; }
.border-success { border-color: #1cc88a !important; }
.border-info { border-color: #36b9cc !important; }
.border-warning { border-color: #f6c23e !important; }
.border-secondary { border-color: #858796 !important; }

h4 {
    position: relative;
    padding-left: 12px;
}
h4::before {
    content: '';
    position: absolute;
    left: 0;
    top: 6px;
    height: 70%;
    width: 4px;
    background: currentColor;
    border-radius: 4px;
}

.table {
    border-radius: 14px;
    overflow: hidden;
}
.table thead {
    background: linear-gradient(135deg, #f8f9fc, #e9ecef);
}
.table tbody tr:hover {
    background-color: #f1f5ff;
}
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">📊 Dashboard </h3>
    <a href="{{ route('logout') }}" class="btn btn-danger shadow-sm">
        🚪 Logout
    </a>
</div>

<!-- Info Box -->
<div class="row mt-3 g-4">
    <div class="col-md-6">
        <div class="card p-4 shadow-sm border-start border-4 border-primary bg-white">
            <p class="mb-1 text-muted">💰 Total Pendapatan</p>
            <h2 class="text-primary fw-bold">
                Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
            </h2>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card p-4 shadow-sm border-start border-4 border-success bg-white">
            <p class="mb-1 text-muted">🧾 Transaksi Hari Ini</p>
            <h2 class="text-success fw-bold">{{ $transaksiHariIni }}</h2>
        </div>
    </div>
</div>

<hr class="my-5">

<!-- Pendapatan per Paket -->
<h4 class="mt-5 mb-4 text-info fw-bold">📦 Pendapatan per Paket Cuci</h4>
<div class="row g-4">
    @foreach ($pendapatanPerPaket as $p)
    <div class="col-md-3">
        <div class="card text-center p-4 shadow-sm border-start border-4 border-info bg-white">
            <strong class="d-block mb-2">🧽 {{ $p->nama_paket }}</strong>
            <p class="text-info fw-bold mb-0">
                Rp {{ number_format($p->total, 0, ',', '.') }}
            </p>
        </div>
    </div>
    @endforeach
</div>

<hr class="my-5">

<!-- Pendapatan per Tipe Kendaraan -->
<h4 class="mt-5 mb-4 text-warning fw-bold">🚗 Pendapatan per Tipe Kendaraan</h4>
<div class="row g-4">
    @foreach ($pendapatanPerTipe as $t)
    <div class="col-md-3">
        <div class="card text-center p-4 shadow-sm border-start border-4 border-warning bg-white">
            <strong class="d-block mb-2">{{ $t->nama_tipe }}</strong>
            <p class="text-warning fw-bold mb-0">
                Rp {{ number_format($t->total, 0, ',', '.') }}
            </p>
        </div>
    </div>
    @endforeach
</div>


<hr class="my-5">

<!-- Jumlah Kendaraan -->
<h4 class="mt-5 mb-4 text-secondary fw-bold">🚘 Jumlah Kendaraan per Tipe</h4>
<div class="row g-4">
    @foreach ($kendaraanPerTipe as $k)
    <div class="col-md-3">
        <div class="card text-center p-4 shadow-sm border-start border-4 border-secondary bg-white">
            <strong class="d-block mb-2"> {{ $k->nama_tipe }}</strong>
            <p class="fw-bold mb-0">{{ $k->total }} Kendaraan</p>
        </div>
    </div>
    @endforeach
</div>

<hr class="my-5">

<h4 class="mt-5 mb-4 text-primary fw-bold">➕ Pendapatan Paket Tambahan</h4>

<div class="row g-4">
    @forelse ($pendapatanPerPaketTambahan as $pt)
        <div class="col-md-3">
            <div class="card text-center p-4 shadow-sm border-start border-4 border-primary bg-white">
                <strong class="d-block mb-2">
                    {{ $pt->nama_tambahan }}
                </strong>
                <p class="fw-bold text-primary mb-0">
                    Rp {{ number_format($pt->total, 0, ',', '.') }}
                </p>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-warning text-center">
                Belum ada pendapatan paket tambahan
            </div>
        </div>
    @endforelse
</div>

<hr class="my-5">

<!-- Transaksi Terbaru -->
<h4 class="mt-5 mb-4 text-secondary fw-bold">🕒 Transaksi Terbaru</h4>
<div class="table-responsive mb-5">
    <table class="table table-bordered bg-white shadow-sm">
        <thead>
            <tr>
                <th>🆔 ID</th>
                <th>👤 Pelanggan</th>
                <th>🚓 No Polisi</th>
                <th>💵 Total Harga</th>
                <th>📅 Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksiTerbaru as $t)
            <tr>
                <td>{{ $t->id }}</td>
                <td>{{ $t->nama_pelanggan }}</td>
                <td>{{ optional($t->kendaraan)->no_plat ?? '-' }}</td>
                <td class="text-success fw-bold">
                    Rp {{ number_format($t->total_harga, 0, ',', '.') }}
                </td>
                <td>{{ $t->created_at->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>



@endsection

@if(session('login_success'))
<div id="login-popup"
     style="
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: linear-gradient(135deg, #4e73df, #224abe);
        color: white;
        padding: 22px 40px;
        border-radius: 14px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.35);
        z-index: 9999;
        font-weight: 600;
        text-align: center;
     ">
    🎉 {{ session('login_success') }}
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const popup = document.getElementById('login-popup');
    setTimeout(() => popup.remove(), 2200);
});
</script>

@php session()->forget('login_success'); @endphp
@endif
