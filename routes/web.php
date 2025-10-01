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
use App\Http\Controllers\SellerDashboardController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\LoginBumdesController;
use App\Http\Controllers\Ai\ChatSellerController;

Route::middleware('auth')->group(function () {
    Route::get('/register-seller', [SellerController::class, 'create'])->name('seller.create');
    Route::post('/register-seller', [SellerController::class, 'store'])->name('seller.store');
});
Route::post('/seller/chatbot/reply', [ChatSellerController::class, 'sendMessage'])
    ->name('chatbot.seller.reply')
    ->middleware('auth'); // pakai middleware sesuai kebutuhan

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



// Halaman produk seller
Route::get('/seller/produk', [ProductController::class, 'index'])->name('seller.products.index');
// Tambah produk
Route::get('/seller/produk/create', [ProductController::class, 'create'])->name('seller.products.create');

Route::get('/seller/produk/{product}/edit', [ProductController::class, 'edit'])->name('seller.products.edit');

Route::delete('/seller/produk/{product}', [ProductController::class, 'destroy'])->name('seller.products.destroy');

Route::post('/seller/produk', [ProductController::class, 'store'])->name('seller.products.store');


Route::prefix('seller')->name('seller.')->middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [SellerDashboardController::class, 'index'])->name('dashboard');

    // Daftar pesanan
    Route::get('/pesanan', [SellerDashboardController::class, 'pesanan'])->name('pesanan');

    // Detail pesanan
    Route::get('/pesanan/{id}', [SellerDashboardController::class, 'show'])->name('pesanan.show');

    // Update status pesanan
    Route::post('/pesanan/{id}/status', [SellerDashboardController::class, 'updateStatus'])
        ->name('pesanan.updateStatus');
});


use App\Http\Controllers\LoginSuperAdminController;

Route::prefix('superadmin')->group(function () {
    // Form login
    Route::get('/login', [LoginSuperAdminController::class, 'showLoginForm'])->name('superadmin.login');
    Route::post('/login', [LoginSuperAdminController::class, 'login'])->name('superadmin.login.post');

    // Logout
    Route::post('/logout', [LoginSuperAdminController::class, 'logout'])->name('superadmin.logout');

    // Dashboard khusus superadmin
    Route::get('/dashboard', function () {
        return view('superadmin.dashboard'); // buat view superadmin/dashboard.blade.php
    })->middleware('auth')->name('superadmin.dashboard');
});

use App\Http\Controllers\SuperAdminController;

Route::prefix('superadmin')->group(function () {
    Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard');
    Route::get('/kelola-bumdes', [SuperAdminController::class, 'kelolaBumdes'])->name('superadmin.kelola-bumdes');
    Route::post('/store-bumdes', [SuperAdminController::class, 'storeBumdes'])->name('superadmin.store-bumdes');
    Route::post('/store-kategori', [SuperAdminController::class, 'storeKategori'])->name('superadmin.kategori.store');
    Route::get('/daftar-bumdes', [SuperAdminController::class, 'daftarBumdes'])->name('superadmin.daftar-bumdes');
    // Edit BUMDES
    Route::get('/bumdes/{id}/edit', [SuperAdminController::class, 'editBumdes'])->name('superadmin.edit-bumdes');

    // Update BUMDES
    Route::put('/bumdes/{id}', [SuperAdminController::class, 'updateBumdes'])->name('superadmin.update-bumdes');

    // Delete BUMDES
    Route::delete('/bumdes/{id}', [SuperAdminController::class, 'deleteBumdes'])->name('superadmin.delete-bumdes');

    Route::get('/toko', [SuperAdminController::class, 'manajemenToko'])->name('superadmin.toko');
    Route::get('/toko/{id}/edit', [SuperAdminController::class, 'editToko'])->name('toko.edit');
    Route::put('/toko/{id}', [SuperAdminController::class, 'updateToko'])->name('toko.update');
    Route::delete('/toko/{id}', [SuperAdminController::class, 'destroyToko'])->name('toko.destroy');

    Route::get('/transaksi', [SuperAdminController::class, 'manajemenTransaksi'])->name('superadmin.transaksi');
    Route::get('/user', [SuperAdminController::class, 'manajemenUser'])->name('superadmin.user');
    

    // web.php
    Route::get('/wilayah/kabupaten/{provinsiId}', [SellerController::class, 'getKabupaten']);
    Route::get('/wilayah/kecamatan/{kabupatenId}', [SellerController::class, 'getKecamatan']);
    Route::get('/wilayah/desa/{kecamatanId}', [SellerController::class, 'getDesa']);
});

Route::get('/bumdes/login', [LoginBumdesController::class, 'showLoginForm'])->name('bumdes.login');
Route::post('/bumdes/login', [LoginBumdesController::class, 'login'])->name('bumdes.login.submit');
Route::post('/bumdes/logout', [LoginBumdesController::class, 'logout'])->name('bumdes.logout');

// khusus update
Route::put('/seller/produk/{product}', [ProductController::class, 'update'])
    ->name('seller.products.update');

// Laporan
Route::get('/seller/laporan', function () {
    return view('seller.laporan');
});

Route::prefix('seller')->name('seller.')->middleware(['auth'])->group(function () {
    // Tampilkan halaman profil
    Route::get('/profil', [SellerDashboardController::class, 'profil'])->name('profil');

    // Update data profil
    Route::patch('/profil', [SellerDashboardController::class, 'updateProfil'])->name('profil.update');
});


Route::prefix('bumdes')->name('bumdes.')->middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [BumdesController::class, 'dashboard'])->name('dashboard');

    // Verifikasi seller
    Route::get('/verifikasi', [BumdesController::class, 'index'])->name('verifikasi');
    Route::get('/verifikasi/{id}', [BumdesController::class, 'show'])->name('verifikasi.show');

    // Approve / Reject (POST, bukan PATCH)
    Route::post('/verifikasi-seller/{id}/approve', [BumdesController::class, 'approve'])
        ->name('verifikasi.approve');
    Route::post('/verifikasi-seller/{id}/reject', [BumdesController::class, 'reject'])
        ->name('verifikasi.reject');

    // Daftar usaha
    Route::get('/usaha', [BumdesController::class, 'daftarUsaha'])->name('usaha');

    // Manajemen seller
    Route::get('/seller', [BumdesController::class, 'manajemenSeller'])->name('seller');

    // Laporan transaksi
    Route::get('/laporan', [BumdesController::class, 'transaksiLaporan'])->name('laporan');

    // Arsip dokumen
    Route::get('/arsip', [BumdesController::class, 'arsipDokumen'])->name('arsip');

    // Profil Bumdes
    Route::get('/profil', [BumdesController::class, 'profil'])->name('profil');
});


Route::prefix('bumdes')->group(function () {
    Route::get('/dashboard', [BumdesController::class, 'dashboard'])->name('bumdes.dashboard');
    Route::get('/verifikasi-seller', [BumdesController::class, 'verifikasi'])->name('bumdes.verifikasi');Route::get('/daftar-usaha', [BumdesController::class, 'daftarUsaha'])->name('bumdes.usaha');
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
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::post('/pesanan/{id}/terima', [PesananController::class, 'terima'])->name('pesanan.terima');
Route::post('/pesanan/{id}/ulasan', [PesananController::class, 'ulasan'])->name('pesanan.ulasan');



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

Route::prefix('bumdes')->name('bumdes.')->group(function () {
    Route::get('/dashboard', [BumdesController::class, 'dashboard'])->name('dashboard');
    Route::get('/verifikasi', [BumdesController::class, 'verifikasi'])->name('verifikasi');
    Route::get('/usaha', [BumdesController::class, 'daftarUsaha'])->name('usaha');
    Route::get('/seller', [BumdesController::class, 'manajemenSeller'])->name('seller');
    Route::get('/laporan', [BumdesController::class, 'transaksiLaporan'])->name('laporan');
    Route::get('/arsip', [BumdesController::class, 'arsipDokumen'])->name('arsip');
    Route::get('/profil', [BumdesController::class, 'profil'])->name('profil');
});

// web.php
Route::get('/wilayah/kabupaten/{provinsiId}', [SellerController::class, 'getKabupaten']);
Route::get('/wilayah/kecamatan/{kabupatenId}', [SellerController::class, 'getKecamatan']);
Route::get('/wilayah/desa/{kecamatanId}', [SellerController::class, 'getDesa']);
Route::get('/wilayah/bumdes/{desaId}', [SellerController::class, 'getBumdes']);
