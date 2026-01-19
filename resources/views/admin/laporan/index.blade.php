@extends('layouts.admin')

@section('title', 'Laporan Penjualan')

@section('content')

<h4 class="mb-4">📊 Laporan Penjualan</h4>


<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.laporan.print', request()->query()) }}"
       target="_blank"
       class="btn btn-outline-dark">
        🖨 Print Laporan
    </a>
</div>

{{-- ================= FILTER ================= --}}
<form method="GET" class="mb-4">
    <div class="row g-3 align-items-end">

        <div class="col-md-3">
            <label class="form-label">Dari Tanggal</label>
            <input type="date" name="dari" value="{{ $dari }}" class="form-control">
        </div>

        <div class="col-md-3">
            <label class="form-label">Sampai Tanggal</label>
            <input type="date" name="sampai" value="{{ $sampai }}" class="form-control">
        </div>

        <div class="col-md-3">
            <label class="form-label">Cari Nama Pelanggan</label>
            <input type="text" name="pelanggan" value="{{ request('pelanggan') }}" class="form-control" placeholder="Cari">
        </div>

        <div class="col-md-1">
            <button class="btn btn-primary w-100">Cari</button>
        </div>

        <div class="col-md-2">
            <a href="{{ route('admin.laporan.index') }}" class="btn btn-secondary w-100">Reset</a>
        </div>

    </div>
</form>

{{-- ================= RINGKASAN ================= --}}
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card p-3 shadow-sm">
            <h6>Jumlah Transaksi</h6>
            <h3>{{ $jumlahTransaksi }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3 shadow-sm">
            <h6>Total Pendapatan</h6>
            <h4>Rp {{ number_format($totalPendapatan,0,',','.') }}</h4>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3 shadow-sm">
            <h6>Cash</h6>
            <h4>Rp {{ number_format($cash,0,',','.') }}</h4>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3 shadow-sm">
            <h6>Transfer</h6>
            <h4>Rp {{ number_format($transfer,0,',','.') }}</h4>
        </div>
    </div>
</div>

{{-- ================= TABEL ================= --}}
<div class="card">
    <div class="card-body">

        <h6 class="mb-3">
            Detail Transaksi
            ({{ \Carbon\Carbon::parse($dari)->format('d M Y') }}
            s/d
            {{ \Carbon\Carbon::parse($sampai)->format('d M Y') }})
        </h6>

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Waktu</th>
                        <th>Nama Pelanggan</th>
                        <th>No Polisi</th>
                        <th>Pembayaran</th>
                        <th class="text-end">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksi as $t)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $t->waktu_transaksi->format('d-m-Y H:i') }}</td>
                        <td>{{ $t->nama_pelanggan }}</td>
                        <td>{{ $t->no_polisi }}</td>
                        <td>
                            <span class="badge {{ $t->metode_pembayaran == 'cash' ? 'bg-success' : 'bg-primary' }}">
                                {{ strtoupper($t->metode_pembayaran) }}
                            </span>
                        </td>
                        <td class="text-end">
                            Rp {{ number_format($t->total_harga,0,',','.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Tidak ada transaksi</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
