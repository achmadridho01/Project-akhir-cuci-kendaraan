@extends('layouts.admin')

@section('title', 'Tambah Member')

@section('content')
<div class="container mt-4">

<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <strong>Tambah Member dari Kendaraan</strong>
    </div>

    <div class="card-body">
        <form action="{{ route('member.store') }}" method="POST">
            @csrf

            <!-- 🔍 SEARCH -->
            <div class="mb-3 position-relative">
                <label>Cari Nama Pelanggan</label>
                <input type="text" id="searchNama" class="form-control" placeholder="Ketik nama...">
                <div id="resultBox" class="list-group position-absolute w-100" style="z-index:1000"></div>
            </div>

            <input type="hidden" name="kendaraan_id" id="kendaraan_id">

            <div class="mb-3">
                <label>Nama Member</label>
                <input type="text" name="nama_member" id="nama" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label>No HP</label>
                <input type="text" name="telepon" id="telepon" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label>Kendaraan</label>
                <input type="text" id="kendaraan" class="form-control" readonly>
            </div>

            <button class="btn btn-success">Simpan & Buat Member</button>
            <a href="{{ route('member.index') }}" class="btn btn-secondary "> Kembali</a>
    </div>
</div>

</div>
@endsection


@push('scripts')
<script>
document.getElementById('searchNama').addEventListener('keyup', function(){
    let q = this.value;
    if(q.length < 2){
        document.getElementById('resultBox').innerHTML = '';
        return;
    }

    fetch('/kendaraan/search-nama?q=' + q)
        .then(res => res.json())
        .then(data => {
            let box = document.getElementById('resultBox');
            box.innerHTML = '';
            data.forEach(k => {
                box.innerHTML += `
                    <a href="#" class="list-group-item list-group-item-action"
                       onclick="pilih(${k.id});return false;">
                        ${k.nama} — ${k.no_plat}
                    </a>
                `;
            });
        });
});

function pilih(id){
    fetch('/kendaraan/' + id + '/detail')
        .then(res => res.json())
        .then(k => {
            document.getElementById('kendaraan_id').value = k.id;
            document.getElementById('nama').value = k.nama;
            document.getElementById('telepon').value = k.telepon;
            document.getElementById('kendaraan').value = k.no_plat + ' (' + k.tipe + ')';
            document.getElementById('searchNama').value = k.nama;
            document.getElementById('resultBox').innerHTML = '';
        });
}
</script>
@endpush
