<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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

Route::get('/regist/seller', function () {
    return view('loginRegist.regist.registSeller');
});

Route::get('/regist/user', function () {
    return view('loginRegist.regist.registUser');
});

// HOMEPAGE SECTION
Route::get('/homePage/home', function () {
    return view('homePage.homePage');
})->name('home');

