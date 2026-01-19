<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TipeKendaraanController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\PaketCuciController;
use App\Http\Controllers\PaketHargaController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PaketTambahanController;


/*
|--------------------------------------------------------------------------
| REDIRECT AWAL
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => redirect('/login'));

/*
|--------------------------------------------------------------------------
| LOGIN & LOGOUT
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| SETELAH LOGIN
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD GLOBAL
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', function () {
        return auth()->user()->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('kasir.dashboard');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD PER ROLE
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard')
        ->middleware('role:admin');

    Route::get('/kasir/dashboard', [DashboardController::class, 'index'])
        ->name('kasir.dashboard')
        ->middleware('role:kasir');

    /*
    |--------------------------------------------------------------------------
    | MEMBER (ADMIN & KASIR - FULL AKSES)
    |--------------------------------------------------------------------------
    */
   Route::middleware('role:admin,kasir')
    ->prefix('member')      // URI: /member/...
    ->name('member.')       // route name: member.xxx
    ->group(function () {

        // INDEX / CREATE / STORE / SHOW / EDIT / UPDATE / DESTROY
        Route::get('/', [MemberController::class, 'index'])->name('index');
        Route::get('/create', [MemberController::class, 'create'])->name('create');
        Route::post('/store', [MemberController::class, 'store'])->name('store');
        Route::get('/{id}', [MemberController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [MemberController::class, 'edit'])->name('edit');
        Route::post('/{id}/update', [MemberController::class, 'update'])->name('update');
        Route::delete('/{id}/delete', [MemberController::class, 'destroy'])->name('destroy');

        // KARTU MEMBER
        Route::get('/{id}/card', [MemberController::class, 'card'])->name('card');

        // PRINT MEMBER
        Route::get('/{id}/print', [MemberController::class, 'print'])->name('print');
});


    /*
    |--------------------------------------------------------------------------
    | KENDARAAN (ADMIN & KASIR)
    |--------------------------------------------------------------------------
    */
   Route::middleware('role:admin,kasir')
    ->prefix('kendaraan')
    ->name('kendaraan.')
    ->group(function () {

        // 🔥 AUTOCOMPLETE MEMBER
        Route::get('/search-nama', [KendaraanController::class, 'searchNama']);
        Route::get('/{id}/detail', [KendaraanController::class, 'detail']);

        // kendaraan biasa
        Route::get('/', [KendaraanController::class, 'index'])->name('index');
        Route::get('/tambah', [KendaraanController::class, 'create'])->name('create');
        Route::post('/tambah', [KendaraanController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [KendaraanController::class, 'edit'])->name('edit');
        Route::post('/edit/{id}', [KendaraanController::class, 'update'])->name('update');
        Route::delete('/hapus/{id}', [KendaraanController::class, 'destroy'])->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN ONLY
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

            Route::prefix('pengguna')->name('pengguna.')->group(function () {
                Route::get('/', [UserController::class, 'index'])->name('index');
                Route::get('/tambah', [UserController::class, 'create'])->name('create');
                Route::post('/tambah', [UserController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
                Route::post('/edit/{id}', [UserController::class, 'update'])->name('update');
                Route::delete('/hapus/{id}', [UserController::class, 'destroy'])->name('destroy');
            });

            Route::prefix('tipe-kendaraan')->name('tipe.')->group(function () {
                Route::get('/', [TipeKendaraanController::class, 'index'])->name('index');
                Route::get('/tambah', [TipeKendaraanController::class, 'create'])->name('create');
                Route::post('/tambah', [TipeKendaraanController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [TipeKendaraanController::class, 'edit'])->name('edit');
                Route::post('/edit/{id}', [TipeKendaraanController::class, 'update'])->name('update');
                Route::delete('/hapus/{id}', [TipeKendaraanController::class, 'destroy'])->name('destroy');
            });

            Route::prefix('paket-cuci')->name('paketcuci.')->group(function () {
                Route::get('/', [PaketCuciController::class, 'index'])->name('index');
                Route::get('/tambah', [PaketCuciController::class, 'create'])->name('create');
                Route::post('/tambah', [PaketCuciController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [PaketCuciController::class, 'edit'])->name('edit');
                Route::post('/edit/{id}', [PaketCuciController::class, 'update'])->name('update');
                Route::delete('/hapus/{id}', [PaketCuciController::class, 'destroy'])->name('destroy');
            });

            Route::prefix('paket-harga')->name('paketharga.')->group(function () {
                Route::get('/', [PaketHargaController::class, 'index'])->name('index');
                Route::get('/tambah', [PaketHargaController::class, 'create'])->name('create');
                Route::post('/tambah', [PaketHargaController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [PaketHargaController::class, 'edit'])->name('edit');
                Route::post('/edit/{id}', [PaketHargaController::class, 'update'])->name('update');
                Route::delete('/hapus/{id}', [PaketHargaController::class, 'destroy'])->name('destroy');
            });
Route::prefix('paket_tambahan')->name('pakettambahan.')->group(function () {
    Route::get('/', [PaketTambahanController::class, 'index'])->name('index'); // menampilkan tabel
    Route::get('/tambah', [PaketTambahanController::class, 'create'])->name('create'); // form create
    Route::post('/tambah', [PaketTambahanController::class, 'store'])->name('store'); // simpan baru

    Route::get('/edit/{id}', [PaketTambahanController::class, 'edit'])->name('edit'); // form edit
    Route::put('/update/{id}', [PaketTambahanController::class, 'update'])->name('update'); // simpan update

    Route::delete('/hapus/{id}', [PaketTambahanController::class, 'destroy'])->name('destroy'); // hapus
});


            Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('laporan.index');

    // ✅ TAMBAHKAN INI
    Route::get('/laporan/print', 
        [LaporanController::class, 'print']
    )->name('laporan.print');

});
    /*
    |--------------------------------------------------------------------------
    | TRANSAKSI (ADMIN & KASIR)
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin,kasir')->group(function () {
        Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
        Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');
        Route::get('/transaksi/struk/{id}', [TransaksiController::class, 'struk'])->name('transaksi.struk');
        Route::get('/transaksi/cari-pelanggan', [TransaksiController::class, 'cariPelanggan'])->name('transaksi.cariPelanggan');
        Route::get('/transaksi/paket/{tipe}', [TransaksiController::class, 'paketByTipe'])->name('transaksi.paket');
        Route::get('/transaksi/cari-member', [TransaksiController::class, 'cariMember']);
        Route::get('/transaksi/paket-tambahan', function () {
    return \App\Models\PaketTambahan::select('id','nama_tambahan','harga')->get();
});


    });

});

