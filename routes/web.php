<?php

use Illuminate\Support\Facades\Route;

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
});
