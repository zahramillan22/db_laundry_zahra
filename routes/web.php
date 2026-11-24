<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\TransaksiController;
use App\Models\Transaksi;
use App\Models\Layanan;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect('/login'));

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $totalTransaksi = Transaksi::count();
        $transaksiProses = Transaksi::where('status', 'Proses')->count();
        $totalPendapatan = Transaksi::where('status', 'Selesai')->sum('total_harga');
        $jumlahLayanan = Layanan::count();

        return view('dashboard', compact('totalTransaksi', 'transaksiProses', 'totalPendapatan', 'jumlahLayanan'));
    })->name('dashboard');

    // CRUD Layanan (Admin kelola data layanan, Kasir melihat daftar layanan)[cite: 1]
    Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
    Route::middleware('role:admin')->group(function () {
        Route::post('/layanan', [LayananController::class, 'store'])->name('layanan.store');
        Route::put('/layanan/{layanan}', [LayananController::class, 'update'])->name('layanan.update');
        Route::delete('/layanan/{layanan}', [LayananController::class, 'destroy'])->name('layanan.destroy');
    });

   // Rekap & Input Transaksi (Admin & Kasir)
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::put('/transaksi/{id}/selesai', [TransaksiController::class, 'selesai'])->name('transaksi.status');
});