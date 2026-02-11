@extends('layouts.admin')

@section('content')
<h1>Rekap Rating Kasir</h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama Kasir</th>
            <th>Jumlah Rating</th>
            <th>Rata-Rata Rating</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
            <tr>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>{{ number_format($item->rata_rata, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
