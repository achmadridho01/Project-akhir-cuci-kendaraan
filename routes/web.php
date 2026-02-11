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
use App\Http\Controllers\RatingController;
use App\Http\Controllers\RekapRatingController;

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
        ->middleware('role:admin')
        ->name('admin.dashboard');

    Route::get('/kasir/dashboard', [DashboardController::class, 'index'])
        ->middleware('role:kasir')
        ->name('kasir.dashboard');

    /*
    |--------------------------------------------------------------------------
    | MEMBER (ADMIN & KASIR)
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin,kasir')
        ->prefix('member')
        ->name('member.')
        ->group(function () {

            Route::get('/', [MemberController::class, 'index'])->name('index');
            Route::get('/create', [MemberController::class, 'create'])->name('create');
            Route::post('/store', [MemberController::class, 'store'])->name('store');
            Route::get('/{id}', [MemberController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [MemberController::class, 'edit'])->name('edit');
            Route::post('/{id}/update', [MemberController::class, 'update'])->name('update');
            Route::delete('/{id}/delete', [MemberController::class, 'destroy'])->name('destroy');

            Route::get('/{id}/card', [MemberController::class, 'card'])->name('card');
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

            Route::get('/search-nama', [KendaraanController::class, 'searchNama']);
            Route::get('/{id}/detail', [KendaraanController::class, 'detail']);

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

            Route::prefix('paket-tambahan')->name('pakettambahan.')->group(function () {
                Route::get('/', [PaketTambahanController::class, 'index'])->name('index');
                Route::get('/tambah', [PaketTambahanController::class, 'create'])->name('create');
                Route::post('/tambah', [PaketTambahanController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [PaketTambahanController::class, 'edit'])->name('edit');
                Route::put('/update/{id}', [PaketTambahanController::class, 'update'])->name('update');
                Route::delete('/hapus/{id}', [PaketTambahanController::class, 'destroy'])->name('destroy');
            });

            Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
            Route::get('/laporan/print', [LaporanController::class, 'print'])->name('laporan.print');

Route::get('/rekap_rating', [RekapRatingController::class, 'index'])
    ->name('rekap_rating');
   


        });

    /*
    |--------------------------------------------------------------------------
    | TRANSAKSI (ADMIN & KASIR)
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin,kasir')
        ->prefix('transaksi')
        ->name('transaksi.')
        ->group(function () {

            Route::get('/create', [TransaksiController::class, 'create'])->name('create');
            Route::post('/store', [TransaksiController::class, 'store'])->name('store');
            Route::get('/struk/{id}', [TransaksiController::class, 'struk'])->name('struk');

            // 🔥 AUTOCOMPLETE MEMBER
            Route::get('/cari-member', [TransaksiController::class, 'cariMember'])
                ->name('cariMember');

            // 🔥 PAKET BY TIPE
            Route::get('/paket/{tipe}', [TransaksiController::class, 'paketByTipe'])
                ->name('paket');

            // 🔥 PAKET TAMBAHAN
            Route::get('/paket-tambahan', function () {
                return \App\Models\PaketTambahan::select('id', 'nama_tambahan', 'harga')->get();
            })->name('paketTambahan');
        });

      Route::middleware(['auth'])->group(function () {
    Route::get('/rating/{id}', [RatingController::class, 'create'])->name('rating.create');
    Route::post('/rating/{id}', [RatingController::class, 'store'])->name('rating.store');
});

});
