<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Struk Transaksi</title>

<style>
    body {
        font-family: monospace;
        background: #f5f5f5;
        color: #000;
    }
    .struk {
        width: 300px;
        margin: 30px auto;
        background: #fff;
        border: 1px solid #000;
        padding: 10px;
        font-size: 12px;
    }
    .center { text-align: center; }
    .right { text-align: right; }

    hr {
        border: none;
        border-top: 1px dashed #000;
        margin: 6px 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }
    td {
        vertical-align: top;
        padding: 2px 0;
    }

    .actions {
        text-align: center;
        margin-top: 12px;
    }

    button, a.btn {
        display: inline-block;
        margin: 4px;
        padding: 6px 10px;
        font-size: 12px;
        text-decoration: none;
        border: 1px solid #000;
        background: #fff;
        color: #000;
        cursor: pointer;
    }

    @media print {
        body { background: #fff; }
        .actions { display: none; }
    }
</style>
</head>

<body>

<div class="struk">

    <div class="center">
        <strong>Wash the Vehicle</strong><br>
        Jl. Ra Basuni No.161<br>
        Telp: 0819-1643-4457
    </div>

    <hr>

    <table>
        <tr>
            <td>Tanggal</td>
            <td class="right">
                {{ $transaksi->created_at->format('d/m/Y H:i') }}
            </td>
        </tr>
        <tr>
            <td>Kasir</td>
            <td class="right">{{ $transaksi->user->name }}</td>
        </tr>
        <tr>
            <td>Pelanggan</td>
            <td class="right">{{ $transaksi->nama_pelanggan }}</td>
        </tr>
        <tr>
            <td>Plat</td>
            <td class="right">{{ $transaksi->no_polisi }}</td>
        </tr>
    </table>

    <hr>

    {{-- PAKET CUCI --}}
    <table>
        @foreach($transaksi->items as $item)
        <tr>
            <td colspan="2"><strong>{{ $item->paketCuci->nama_paket }}</strong></td>
        </tr>
        <tr>
            <td>{{ $item->qty }} x</td>
            <td class="right">
                Rp {{ number_format($item->subtotal,0,',','.') }}
            </td>
        </tr>
        @endforeach
    </table>

    {{-- PAKET TAMBAHAN --}}
    @if($transaksi->tambahans->count())
    <hr>
    <table>
        <tr>
            <td colspan="2"><strong>Paket Tambahan</strong></td>
        </tr>

        @foreach($transaksi->tambahans as $tambahan)
        <tr>
            <td colspan="2">
                {{ $tambahan->paketTambahan?->nama_tambahan ?? 'Paket Tambahan' }}
            </td>
        </tr>
        <tr>
            <td>{{ $tambahan->qty }} x</td>
            <td class="right">
                Rp {{ number_format($tambahan->subtotal,0,',','.') }}
            </td>
        </tr>
        @endforeach
    </table>
    @endif

    <hr>

    {{-- TOTAL --}}
    <table>
        <tr>
            <td><strong>SUBTOTAL</strong></td>
            <td class="right">
                Rp {{ number_format($transaksi->total_harga,0,',','.') }}
            </td>
        </tr>

        <tr>
            <td><strong>DISKON</strong></td>
            <td class="right">
                Rp {{ number_format($transaksi->diskon,0,',','.') }}
            </td>
        </tr>

       

        <tr>
            <td>BAYAR</td>
            <td class="right">
                Rp {{ number_format($transaksi->bayar ?? 0,0,',','.') }}
            </td>
        </tr>

        @if($transaksi->metode_pembayaran === 'cash')
        <tr>
            <td>KEMBALIAN</td>
            <td class="right">
                Rp {{ number_format($transaksi->kembalian ?? 0,0,',','.') }}
            </td>
        </tr>
        @endif
    </table>

    <hr>

    {{-- TANDA GRATIS --}}
    @if($transaksi->diskon >= $transaksi->total_harga && $transaksi->total_harga > 0)
        <div class="center" style="font-weight:bold; margin:6px 0;">
             <br>
           
        </div>
        <hr>
    @endif

    <div class="center">
        TERIMA KASIH<br>
        SELAMAT JALAN
    </div>
<div class="actions">
    <button onclick="window.print()">Cetak</button>
    <a href="{{ route('dashboard') }}" class="btn">Kembali</a>

    @if(auth()->user()->role === 'kasir')
    <!-- Rating hanya tampil di layar, tidak tercetak -->
    <a href="{{ route('rating.create', $transaksi->id) }}" class="btn btn">
        Beri Rating Pelayanan Kasir
    </a>
    @endif
</div>

<style>
@media print {
    .actions {
        display: none; /* semua tombol di actions tidak dicetak */
    }
}
.actions {
    text-align: center;
    margin-top: 12px;
}
.actions .btn {
    display: inline-block;
    margin: 4px;
    padding: 6px 10px;
    font-size: 12px;
    text-decoration: none;
    border: 1px solid #000;
    background: #fff;
    color: #000;
    cursor: pointer;
}
</style>


</body>
</html>


