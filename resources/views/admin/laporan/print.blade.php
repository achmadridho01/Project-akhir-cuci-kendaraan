<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #000;
        }

        h2, h4 {
            text-align: center;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
        }

        th {
            background: #f0f0f0;
        }

        .text-right {
            text-align: right;
        }

        @media print {
            @page {
                margin: 15mm;
            }
        }
    </style>
</head>

<body onload="window.print()">

    {{-- JUDUL --}}
    <h2>LAPORAN PENJUALAN</h2>
    <h4>
        Periode {{ \Carbon\Carbon::parse($dari)->format('d M Y') }}
        s/d
        {{ \Carbon\Carbon::parse($sampai)->format('d M Y') }}
    </h4>

    {{-- RINGKASAN --}}
    <table>
        <tr>
            <td><strong>Jumlah Transaksi</strong></td>
            <td>{{ $jumlahTransaksi }}</td>
        </tr>
        <tr>
            <td><strong>Total Pendapatan</strong></td>
            <td>Rp {{ number_format($totalPendapatan,0,',','.') }}</td>
        </tr>
        <tr>
            <td><strong>Cash</strong></td>
            <td>Rp {{ number_format($cash,0,',','.') }}</td>
        </tr>
        <tr>
            <td><strong>Transfer</strong></td>
            <td>Rp {{ number_format($transfer,0,',','.') }}</td>
        </tr>
    </table>

    {{-- DETAIL --}}
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Waktu</th>
                <th>Nama Pelanggan</th>
                <th>No Polisi</th>
                <th>Pembayaran</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi as $t)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $t->waktu_transaksi->format('d-m-Y H:i') }}</td>
                <td>{{ $t->nama_pelanggan }}</td>
                <td>{{ $t->no_polisi }}</td>
                <td>{{ strtoupper($t->metode_pembayaran) }}</td>
                <td class="text-right">
                    Rp {{ number_format($t->total_harga,0,',','.') }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
