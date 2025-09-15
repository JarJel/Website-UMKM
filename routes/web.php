<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;

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

//LOGIN USER
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// LOGIN SECTION
Route::get('/login/user', function () {
    return view('loginRegist.login');
});

// REGISTRATION SECTION
Route::get('/regist/admin', function () {
    return view('loginRegist.regist.registAdmin');
});


// HOMEPAGE SECTION
Route::get('/homePage/home', function () {
    return view('homePage.homePage');
})->name('home');

