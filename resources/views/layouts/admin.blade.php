<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Dashboard') - Cuci Mobil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body { background: #f5f6fa; }

        /* Sidebar */
        .sidebar { 
            height: 100vh; 
            background: #fff; 
            padding: 20px; 
            border-right: 1px solid #ddd; 
        }
        .sidebar h4 { font-weight: bold; margin-bottom: 0; }
        .sidebar small { color: #555; display:block; margin-bottom: 20px; }

        /* Menu item as button */
        .menu-item { 
            display: block; 
            padding: 10px 15px; 
            font-size: 16px; 
            margin-bottom: 10px;
            border-radius: 8px;
            text-decoration: none;
            background-color: #f0f0f0; 
            color: #000; 
            font-weight: bold;
            transition: all 0.2s;
            text-align: center;
        }
        .menu-item:hover {
            background-color: #ddd; 
            color: #000; 
            text-decoration: none;
        }

        /* Card info */
        .card-info { 
            padding: 20px; 
            border-radius: 10px; 
            background: white; 
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            border-left: 5px solid #0d6efd; 
        }
    </style>
</head>


@if(session('login_success'))
<div id="login-popup"
     style="
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0.9);
        background: #0d6efd;
        color: white;
        padding: 22px 40px;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.35);
        z-index: 9999;
        font-weight: 600;
        font-size: 16px;
        opacity: 0;
        transition: all 0.4s ease;
        text-align: center;
     ">
    ✅ {{ session('login_success') }}
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const popup = document.getElementById('login-popup');
    if (!popup) return;

    popup.style.opacity = 1;
    popup.style.transform = "translate(-50%, -50%) scale(1)";

    setTimeout(() => {
        popup.style.opacity = 0;
        popup.style.transform = "translate(-50%, -50%) scale(0.9)";
        setTimeout(() => popup.remove(), 400);
    }, 2200);
});
</script>
@endif


<body>
<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
      <div class="col-2 sidebar">
    <h4>Cuci Mobil</h4>
    <small>{{ auth()->user()->role }}</small>

    <div class="mt-4">
        <!-- Dashboard untuk semua role -->
        <a href="{{ route('dashboard') }}" class="menu-item">Dashboard</a>

<a href="{{ route('kendaraan.index') }}" class="menu-item">Kendaraan</a>
<a href="{{ route('member.index') }}" class="menu-item">Member</a>
<a href="{{ route('transaksi.create') }}" class="menu-item">Transaksi</a>

@if(auth()->user()->role === 'admin')
    <a href="{{ route('admin.pengguna.index') }}" class="menu-item">Pengguna</a>
    <a href="{{ route('admin.tipe.index') }}" class="menu-item">Tipe Kendaraan</a>
    <a href="{{ route('admin.paketcuci.index') }}" class="menu-item">Paket Cuci</a>
    <a href="{{ route('admin.paketharga.index') }}" class="menu-item">Paket Harga</a>
    <a href="{{ route('admin.pakettambahan.index') }}" class="menu-item">Paket Tambahan</a>
    <a href="{{ route('admin.laporan.index') }}" class="menu-item">Laporan</a>
@endif

      
    </div>
</div>


        <!-- Content -->
        <div class="col-10 p-4">
            @yield('content')
        </div>

    </div>
</div>

@stack('scripts')
</body>
</html>
