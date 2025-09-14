<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;

//REGIST USER
Route::get('/regist/user', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');

//REGIST SELLER
Route::get('/regist/seller', [AuthController::class, 'showRegistSellerForm'])->name('registerSeller');
Route::post('/registSeller', [AuthController::class, 'registerSeller'])->name('registerSeller');

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

