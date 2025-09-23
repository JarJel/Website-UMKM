<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\BumdesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GeminiController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\CheckoutController;
//REGIST SELLER
Route::get('/register-seller', [SellerController::class, 'create'])->name('seller.create');
Route::post('/register-seller', [SellerController::class, 'store'])->name('seller.store');

//REGIST USER
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/verify-code', [AuthController::class,'showVerifyCodeForm'])->name('verify.code.form');
Route::post('/verify-code', [AuthController::class,'verifyCode'])->name('verify.code');

//REGIST BUMDES
Route::get('/register-bumdes', [BumdesController::class, 'showFormBumdes'])->name('registBumdes');
Route::post('/register-bumdes', [BumdesController::class, 'registBumdes'])->name('registBumdes');

//LOGIN USER
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/auth/google', [LoginController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::get('/phpinfo', function() {
    phpinfo();
});

Route::get('/profile', [ProfileController::class, 'index'])->name('profile')->middleware('auth');

// HOMEPAGE SECTION
Route::get('/homePage/home', function () {
    return view('homePage.homePage');
})->name('home');

Route::get('/seller/gemini', [GeminiController::class, 'index'])->name('seller.gemini');

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

Route::prefix('bumdes')->group(function () {
    Route::get('/dashboard', [BumdesController::class, 'dashboard'])->name('bumdes.dashboard');
    Route::get('/verifikasi-seller', [BumdesController::class, 'verifikasiSeller'])->name('bumdes.verifikasi');
    Route::get('/daftar-usaha', [BumdesController::class, 'daftarUsaha'])->name('bumdes.usaha');
    Route::get('/manajemen_seller', [BumdesController::class, 'manajemenSeller'])->name('bumdes.seller');
    Route::get('/transaksi-laporan', [BumdesController::class, 'transaksiLaporan'])->name('bumdes.laporan');
    Route::get('/arsip-dokumen', [BumdesController::class, 'arsipDokumen'])->name('bumdes.arsip');
    Route::get('/profil', [BumdesController::class, 'profil'])->name('bumdes.profil');
});

use App\Http\Controllers\HomeController;

Route::get('/homePage/home', [HomeController::class, 'index'])->name('home');

Route::view('/checkout', 'checkout.checkout')->name('checkout');
Route::get('/toko/{id}', [TokoController::class, 'show'])->name('toko.show');


use App\Http\Controllers\CartController;

Route::get('/keranjang/dropdown', [CartController::class, 'dropdown'])->name('keranjang.dropdown');
Route::post('/keranjang/add/{id_produk}', [CartController::class, 'add'])->name('keranjang.add');
Route::delete('/keranjang/item/{id}', [CartController::class, 'removeItem'])->name('keranjang.removeItem');

Route::get('/keranjang', [CartController::class, 'index'])->name('keranjang.index');
Route::post('/keranjang/update/{id}', [CartController::class, 'updateItem']);
Route::delete('/keranjang/remove/{id}', [CartController::class, 'removeItem']);

Route::get('/produk/{id}', [ProductController::class, 'show'])->name('produk.show');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');


// Reset password
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Email verification
Route::get('email/verify', [EmailVerificationController::class, 'notice'])->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware(['signed'])->name('verification.verify');
Route::post('email/resend', [EmailVerificationController::class, 'resend'])->name('verification.resend');

Route::get('/kategori/{id}', [KategoriController::class, 'show'])->name('kategori.show');

use App\Http\Controllers\CheckoutPendingController;

Route::post('/checkout/process', [CheckoutPendingController::class, 'process'])
    ->name('checkout.pending.process')
    ->middleware('auth');

Route::get('/checkout/{id_pending}/payment', [CheckoutPendingController::class, 'payment'])
    ->name('checkout.payment');

Route::post('/checkout/{id_pending}/confirm', [CheckoutPendingController::class, 'confirmPayment'])
    ->name('checkout.confirm');

Route::post('/checkout/{id_pending}/pay', [CheckoutController::class,'payNow'])
    ->name('checkout.payNow');

Route::get('/checkout/{id_pesanan}/success', [CheckoutController::class,'success'])
    ->name('checkout.success');

Route::middleware('auth')->group(function () {
    Route::get('/checkout/{id}/payment', [CheckoutController::class,'payment'])->name('checkout.payment');
    Route::post('/checkout/{id}/pay', [CheckoutController::class,'payNow'])->name('checkout.payNow');

    Route::get('/alamat/list', [CheckoutController::class,'alamatList'])->name('alamat.list');
    Route::post('/alamat/pilih/{id}', [CheckoutController::class,'pilihAlamat']);
});


Route::middleware(['auth'])->group(function () {
    Route::post('/alamat/store', [AlamatController::class, 'store'])->name('alamat.store');
    Route::get('/alamat/list', [AlamatController::class, 'list'])->name('alamat.list');
    Route::post('/alamat/pilih/{id_alamat}', [AlamatController::class, 'pilihAlamat'])->name('alamat.pilih');

});

Route::middleware('auth')->group(function() {
    Route::get('/pesanan/{id}/tracking', [CheckoutController::class, 'tracking'])
        ->name('checkout.tracking');
});

use App\Http\Controllers\SellerDashboardController;

Route::get('/seller/pesanan', [SellerDashboardController::class, 'index'])
    ->name('seller.pesanan')
    ->middleware('auth');


