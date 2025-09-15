<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\BumdesController;

Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('products', [ProductController::class, 'store'])->name('products.store');

//REGIST SELLER
Route::get('/register-seller', [SellerController::class, 'create'])->name('seller.create');
Route::post('/register-seller', [SellerController::class, 'store'])->name('seller.store');

//REGIST USER
Route::get('/regist/user', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');

//REGIST BUMDES
Route::get('/register-bumdes', [BumdesController::class, 'showFormBumdes'])->name('registBumdes');
Route::post('/register-bumdes', [BumdesController::class, 'registBumdes'])->name('registBumdes');

//LOGIN USER
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// LOGIN SECTION
Route::get('/login/user', function () {
    return view('loginRegist.login');
});

// HOMEPAGE SECTION
Route::get('/homePage/home', function () {
    return view('homePage.homePage');
})->name('home');

