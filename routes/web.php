<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\BumdesController;
use App\Http\Controllers\ProfileController;

//REGIST SELLER
Route::get('/register-seller', [SellerController::class, 'create'])->name('seller.create');
Route::post('/register-seller', [SellerController::class, 'store'])->name('seller.store');

//REGIST USER
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

//REGIST BUMDES
Route::get('/register-bumdes', [BumdesController::class, 'showFormBumdes'])->name('registBumdes');
Route::post('/register-bumdes', [BumdesController::class, 'registBumdes'])->name('registBumdes');

//LOGIN USER
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::get('/auth/google', [LoginController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::get('/phpinfo', function() {
    phpinfo();
});

Route::get('/profile', [ProfileController::class, 'index'])->name('profile')->middleware('auth');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// HOMEPAGE SECTION
Route::get('/homePage/home', function () {
    return view('homePage.homePage');
})->name('home');

Route::get('/seller/dashboard', function () {
    return view('seller.dashboard');
})->name('seller.dashboard');

// Halaman produk seller
Route::get('/seller/produk', [ProductController::class, 'index'])->name('seller.products.index');
// Tambah produk
Route::get('/seller/produk/create', [ProductController::class, 'create'])->name('seller.products.create');

Route::get('/seller/produk/{product}/edit', [ProductController::class, 'edit'])->name('seller.products.edit');

Route::delete('/seller/produk/{product}', [ProductController::class, 'destroy'])->name('seller.products.destroy');

Route::post('/seller/produk', [ProductController::class, 'store'])->name('seller.products.store');

// khusus update
Route::put('/seller/produk/{product}', [ProductController::class, 'update'])
    ->name('seller.products.update');


// Pesanan
Route::get('/seller/pesanan', function () {
    return view('seller.pesanan');
});

// Laporan
Route::get('/seller/laporan', function () {
    return view('seller.laporan');
});

// Profil UMKM
Route::get('/seller/profil', function () {
    return view('seller.profil');
});

Route::prefix('bumdes')->middleware('auth')->group(function(){
    Route::get('verifikasi-toko', [BumdesController::class, 'index'])->name('bumdes.verifikasi.index');
    Route::get('verifikasi-toko/{id}/edit', [BumdesController::class, 'edit'])->name('bumdes.verifikasi.edit');
    Route::post('verifikasi-toko/{id}/update', [BumdesController::class, 'update'])->name('bumdes.verifikasi.update');
});
