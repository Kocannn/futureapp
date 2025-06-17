<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PaketController;
use App\Http\Controllers\Admin\SoalController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\TryoutController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\CheckRole;
use App\Models\Paket;

// ============================
// ✅ GUEST ROUTES
// ============================

// Halaman welcome menampilkan semua paket
Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('dashboard');
    }
    $pakets = Paket::all();
    return view('welcome', compact('pakets'));
});




// ============================
// ✅ AUTHENTICATED USER ROUTES
// ============================
Route::middleware(['auth', 'verified', CheckRole::class . ':user'])->group(function () {

    // Dashboard user
    Route::get('/dashboard', [DashboardUserController::class, 'index'])->name('dashboard');

    // Tryout
    Route::prefix('tryout')->name('tryout.')->group(function () {
        Route::get('/', [TryoutController::class, 'index'])->name('index');
        Route::get('/{id}/mulai', [TryoutController::class, 'mulai'])->name('mulai');
        Route::post('/{id}/submit', [TryoutController::class, 'submit'])->name('submit');
        Route::get('/{id}/hasil', [TryoutController::class, 'hasil'])->name('hasil');
        Route::get('/tryout/hasil/{hasil_id}', [App\Http\Controllers\DashboardUserController::class, 'showHasil'])->name('tryout.hasil');
        Route::get('/dashboard/hasil/{hasil_id}', [App\Http\Controllers\DashboardUserController::class, 'showHasil'])->name('dashboard.hasil');
        Route::get('/history', [DashboardUserController::class, 'history'])->name('history');

        Route::get('/{id}/export-pdf', [TryoutController::class, 'exportPdf'])->name('export.pdf');
        Route::get('/tryout/history/export-pdf', [DashboardUserController::class, 'exportHistoryPdf'])->name('history.export.pdf');
    });
    // PDF Export routes

    // Profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });
});


// ============================
// ✅ ADMIN ROUTES
// ============================
Route::middleware(['auth', CheckRole::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Manajemen Users
    Route::resource('users', UserController::class);
    // Manajemen Paket & Kategori
    Route::resource('paket', PaketController::class);
    Route::resource('kategori', KategoriController::class);
    // Soal
    Route::resource('soal', SoalController::class);

    // Hasil dan Peringkat
    Route::get('/hasil', [DashboardController::class, 'hasilTryout'])->name('hasil.index');
    Route::get('/hasil/{paket_id}', [DashboardController::class, 'hasilShow'])->name('hasil.show');
    Route::get('/peringkat', [DashboardController::class, 'listPaketPeringkat'])->name('peringkat.index');
    Route::get('/peringkat/top', [DashboardController::class, 'topRankings'])->name('peringkat.top');
    Route::get('/peringkat/{paket_id}', [DashboardController::class, 'peringkat'])->name('peringkat.show');
    Route::get('/hasil/{id}/pdf', [App\Http\Controllers\Admin\DashboardController::class, 'exportPdf'])->name('admin.hasil.export.pdf');
});

require __DIR__ . '/auth.php';
