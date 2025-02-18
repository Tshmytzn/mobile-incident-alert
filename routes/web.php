<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//User's Routes  

// Login
Route::get('/login', function () {
    return view('login');
});

//Administrator Routes

// Login
Route::get('/administrator', function () {
    return view('adminlogin');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('Administrator.dashboard');
});