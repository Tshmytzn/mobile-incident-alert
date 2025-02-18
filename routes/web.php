<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//User Login
Route::get('/login', function () {
    return view('login');
});

//Admin Login
Route::get('/administrator', function () {
    return view('Adminlogin');
});