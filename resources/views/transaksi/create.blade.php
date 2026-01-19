@extends('layouts.admin')

 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')
<style>
/* ===== RADIO CUSTOM ===== */
.custom-radio {
    position: relative;
    padding-left: 32px;
    cursor: pointer;
    user-select: none;
    font-weight: 500;
}

.custom-radio input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.custom-radio .radio-circle {
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    height: 20px;
    width: 20px;
    border: 2px solid #adb5bd;
    border-radius: 50%;
    transition: 0.2s;
}

.custom-radio .radio-circle::after {
    content: "";
    position: absolute;
    display: none;
    top: 50%;
    left: 50%;
    width: 10px;
    height: 10px;
    background: #0d6efd;
    border-radius: 50%;
    transform: translate(-50%, -50%);
}

.custom-radio input:checked ~ .radio-circle {
    border-color: #0d6efd;
}

.custom-radio input:checked ~ .radio-circle::after {
    display: block;
}

.custom-radio:hover .radio-circle {
    border-color: #0d6efd;
}

.list-group-item-action:hover {
    cursor: pointer;
    background-color: #e9ecef;
}
</style>

<div class="container-fluid">
    <div class="d-flex align-items-center mb-4">
        <a href="{{ url()->previous() }}" class="me-3 text-decoration-none">←</a>
        <h4 class="mb-0 flex-grow-1 text-center">Proses Isi Transaksi</h4>
    </div>

    <form id="form-transaksi" method="POST" action="{{ route('transaksi.store') }}">

        @csrf

        {{-- INFORMASI PELANGGAN --}}
        <div class="mb-4">
            <h6 class="fw-bold mb-3">Informasi Pelanggan & Kendaraan</h6>

            <div class="mb-3 position-relative">
                <label class="form-label">Nama Pelanggan</label>
                <input type="text" id="nama_pelanggan" name="nama_pelanggan" class="form-control" autocomplete="off" required>
                <div id="suggestion" class="list-group position-absolute w-100" style="z-index:1000"></div>
            </div>

            <div class="mb-3 position-relative">
                <label class="form-label">Kode Member</label>
                <input type="text" id="kode_member" name="kode_member" class="form-control" autocomplete="off">
                <div id="suggestion-kode" class="list-group position-absolute w-100" style="z-index:1000"></div>
            </div>

            <div class="mb-3">
                <label class="form-label">Nomor Telepon</label>
                <input type="text" id="telepon" name="telepon" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Kendaraan</label>
                <select id="tipe_kendaraan" name="tipe_kendaraan_id" class="form-select" required>
                    <option value="">Pilih</option>
                    @foreach(\App\Models\TipeKendaraan::all() as $tipe)
                        <option value="{{ $tipe->id }}">{{ $tipe->nama_tipe }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Nomor Plat</label>
                <input type="text" id="no_plat" name="no_plat" class="form-control">
            </div>

            <div class="mb-3">
    <label class="form-label">Merek & Model</label>
    <div id="merk-container">
        <input type="text" id="merk" name="merk" class="form-control">
    </div>
</div>


        {{-- PAKET CUCI --}}
        <div class="mb-4">
            <h6 class="fw-bold mb-3">Pemilihan Paket Cuci</h6>
            <div id="paket-area"></div>
        </div>

       <div class="mb-4">
    <h6 class="fw-bold mb-3">Paket Tambahan (Opsional)</h6>
    <div id="paket-tambahan-area"></div>
</div>



        {{-- RINGKASAN --}}
        <div class="mb-4">
            <h6 class="fw-bold mb-3">Ringkasan Pembayaran</h6>
            <div id="ringkasan"></div>
            <div class="fw-bold mt-2">
                Total: <span id="total">Rp 0</span>
            </div>
        </div>

        {{-- METODE PEMBAYARAN --}}
        <div class="mb-4">
            <h6 class="fw-bold mb-3">Metode Pembayaran</h6>

            <div class="mb-2">
                <label class="custom-radio">
                    <input type="radio" name="metode_pembayaran" value="cash" checked>
                    <span class="radio-circle"></span> Cash
                </label>
            </div>

            <div class="mb-3">
                <label class="custom-radio">
                    <input type="radio" name="metode_pembayaran" value="transfer">
                    <span class="radio-circle"></span> Transfer
                </label>
            </div>

            <div id="cash-area">
                <label class="form-label">Nominal Bayar</label>
                <input type="number" id="bayar" name="bayar" class="form-control">
                
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    function formatRupiah(angka) {
        return 'Rp ' + Number(angka || 0).toLocaleString('id-ID');
    }

    const namaInput = document.getElementById('nama_pelanggan');
    const kodeInput = document.getElementById('kode_member');
    const teleponInput = document.getElementById('telepon');
    const noPlatInput = document.getElementById('no_plat');
    const tipeSelect = document.getElementById('tipe_kendaraan');
    const merkInput = document.getElementById('merk');
    const merkContainer = document.getElementById('merk-container');

    const box = document.getElementById('suggestion');
    const boxKode = document.getElementById('suggestion-kode');

    let kendaraanMember = [];

    function tampilkanKendaraan(kendaraan) {
        kendaraanMember = kendaraan || [];
        merkContainer.innerHTML = '';

        // Jika hanya 1 kendaraan → auto isi
        if (kendaraanMember.length === 1) {
            const k = kendaraanMember[0];
            merkContainer.innerHTML = `<input type="text" id="merk" name="merk" class="form-control">`;
            document.getElementById('merk').value = k.merk;
            noPlatInput.value = k.no_plat;
            tipeSelect.value = k.tipe_kendaraan_id;
            tipeSelect.dispatchEvent(new Event('change'));
            return;
        }

        // Jika lebih dari 1 → buat dropdown
        if (kendaraanMember.length > 1) {
            let html = `<select id="pilih-kendaraan" class="form-select">
                <option value="">Pilih Kendaraan</option>`;
            kendaraanMember.forEach((k, i) => {
                html += `<option value="${i}">${k.merk} - ${k.no_plat}</option>`;
            });
            html += `</select>`;
            merkContainer.innerHTML = html;

            document.getElementById('pilih-kendaraan').addEventListener('change', function () {
                const k = kendaraanMember[this.value];
                if (!k) return;
                noPlatInput.value = k.no_plat;
                tipeSelect.value = k.tipe_kendaraan_id;
                tipeSelect.dispatchEvent(new Event('change'));
            });
        }

        // Jika tidak ada kendaraan
        if (kendaraanMember.length === 0) {
            merkContainer.innerHTML = `<input type="text" id="merk" name="merk" class="form-control">`;
        }
    }

    function pilihMember(d) {
        namaInput.value = d.nama_pemilik || '';
        kodeInput.value = d.kode_member || '';
        teleponInput.value = d.telepon || '';
        tampilkanKendaraan(d.kendaraan || []);
        box.innerHTML = '';
        boxKode.innerHTML = '';
    }

    // AUTOCOMPLETE NAMA
    namaInput.addEventListener('keyup', function () {
        let q = this.value.trim();
        if (q.length < 2) { box.innerHTML = ''; return; }

        fetch(`/transaksi/cari-member?q=${encodeURIComponent(q)}`)
            .then(r => r.json())
            .then(data => {
                box.innerHTML = '';
                data.forEach(d => {
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'list-group-item list-group-item-action';
                    btn.innerText = d.nama_pemilik + ' - ' + d.kode_member;
                    btn.onclick = () => pilihMember(d);
                    box.appendChild(btn);
                });
            });
    });

    // AUTOCOMPLETE KODE
    kodeInput.addEventListener('keyup', function () {
        let q = this.value.trim();
        if (q.length < 2) { boxKode.innerHTML = ''; return; }

        fetch(`/transaksi/cari-member?q=${encodeURIComponent(q)}`)
            .then(r => r.json())
            .then(data => {
                boxKode.innerHTML = '';
                data.forEach(d => {
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'list-group-item list-group-item-action';
                    btn.innerText = d.kode_member + ' - ' + d.nama_pemilik;
                    btn.onclick = () => pilihMember(d);
                    boxKode.appendChild(btn);
                });
            });
    });

    // ====== PAKET ======
    const paketArea = document.getElementById('paket-area');
    const ringkasan = document.getElementById('ringkasan');
    const totalEl = document.getElementById('total');

    tipeSelect.addEventListener('change', function () {
        paketArea.innerHTML = '';
        ringkasan.innerHTML = '';
        totalEl.innerText = formatRupiah(0);
        if (!this.value) return;

        fetch(`/transaksi/paket/${this.value}`)
            .then(r => r.json())
            .then(data => {
                data.forEach(p => {
                    paketArea.insertAdjacentHTML('beforeend', `
                        <div class="d-flex justify-content-between align-items-center mb-2 p-2 border rounded">
                            <label class="custom-radio mb-0">
                                <input type="radio" name="paket" class="paket-radio"
                                    data-nama="${p.paket_cuci.nama_paket}"
                                    data-harga="${p.harga}"
                                    value="${p.id}">
                                <span class="radio-circle"></span>
                                ${p.paket_cuci.nama_paket}
                            </label>
                            <strong>${formatRupiah(p.harga)}</strong>
                        </div>
                    `);
                });
            });
    });

    document.addEventListener('change', function (e) {
        if (!e.target.classList.contains('paket-radio')) return;
        const harga = parseInt(e.target.dataset.harga);
        ringkasan.innerHTML = `<div>${e.target.dataset.nama} <span class="float-end">${formatRupiah(harga)}</span></div>`;
        totalEl.innerText = formatRupiah(harga);
    });

   // ===== PAKET TAMBAHAN =====
const paketTambahanArea = document.getElementById('paket-tambahan-area');

fetch('/transaksi/paket-tambahan')
.then(r => r.json())
.then(data => {
    paketTambahanArea.innerHTML = '';

    data.forEach(p => {
        paketTambahanArea.insertAdjacentHTML('beforeend', `
            <div class="d-flex justify-content-between align-items-center mb-2 p-2 border rounded">
                <label class="custom-radio mb-0">
                    <input type="checkbox"
                           name="paket_tambahan[]"
                           class="paket-tambahan"
                           value="${p.id}"
                           data-nama="${p.nama_tambahan}"
                           data-harga="${p.harga}">
                    <span class="radio-circle"></span>
                    ${p.nama_tambahan}
                </label>
                <strong>${formatRupiah(p.harga)}</strong>
            </div>
        `);
    });
});

// ===== HITUNG TOTAL (PAKET + TAMBAHAN) =====
document.addEventListener('change', function () {
    let total = 0;
    ringkasan.innerHTML = '';

    const paket = document.querySelector('.paket-radio:checked');
    if (paket) {
        total += parseInt(paket.dataset.harga);
        ringkasan.innerHTML += `<div>${paket.dataset.nama} <span class="float-end">${formatRupiah(paket.dataset.harga)}</span></div>`;
    }

    document.querySelectorAll('.paket-tambahan:checked').forEach(el => {
        total += parseInt(el.dataset.harga);
        ringkasan.innerHTML += `<div>${el.dataset.nama} <span class="float-end">${formatRupiah(el.dataset.harga)}</span></div>`;
    });

    totalEl.innerText = formatRupiah(total);
});


document.addEventListener('DOMContentLoaded', function () {

    const bayarInput = document.getElementById('bayar');
    const kembalianEl = document.getElementById('kembalian');
    const totalEl = document.getElementById('total');

    const cashRadio = document.querySelector('input[name="metode_pembayaran"][value="cash"]');
    const transferRadio = document.querySelector('input[name="metode_pembayaran"][value="transfer"]');

    function getTotalAngka() {
        return parseInt(totalEl.innerText.replace(/[^0-9]/g, '')) || 0;
    }

    function hitungKembalian() {
        if (!cashRadio.checked) return;

        const bayar = parseInt(bayarInput.value) || 0;
        const total = getTotalAngka();
        const kembalian = bayar - total;

        kembalianEl.innerText = kembalian > 0
            ? formatRupiah(kembalian)
            : 'Rp 0';
    }

    // Input nominal
    bayarInput.addEventListener('input', hitungKembalian);

    // Toggle metode pembayaran
    const cashArea = document.getElementById('cash-area');

function toggleBayar() {
    if (cashRadio.checked) {
        cashArea.style.display = 'block'; // tampil
        bayarInput.disabled = false;
        hitungKembalian();
    } else {
        cashArea.style.display = 'none'; // sembunyi
        bayarInput.disabled = true;
        bayarInput.value = '';
    }
}


    cashRadio.addEventListener('change', toggleBayar);
    transferRadio.addEventListener('change', toggleBayar);

    // Update kembalian saat total berubah
    document.addEventListener('change', function () {
        hitungKembalian();
    });

    // Init
    toggleBayar();

});

});


document.getElementById('form-transaksi').addEventListener('submit', function (e) {
    const cashRadio = document.querySelector('input[name="metode_pembayaran"][value="cash"]');
    const bayarInput = document.getElementById('bayar');
    const total = parseInt(
        document.getElementById('total').innerText.replace(/[^0-9]/g, '')
    ) || 0;
    const bayar = parseInt(bayarInput.value) || 0;

    if (!cashRadio.checked) return;

    // 🔴 Nominal kosong
    if (!bayarInput.value) {
        e.preventDefault();
        Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Nominal wajib diisi',
            text: 'Silakan masukkan nominal pembayaran',
            confirmButtonText: 'OK',
            allowOutsideClick: false
        }).then(() => bayarInput.focus());
        return;
    }

    // 🔴 Nominal kurang
    if (bayar < total) {
        e.preventDefault();
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Nominal kurang',
            text: 'Nominal pembayaran lebih kecil dari total transaksi',
            confirmButtonText: 'OK',
            allowOutsideClick: false
        }).then(() => bayarInput.focus());
    }
});


</script>

@endpush

k