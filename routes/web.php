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

// Dashboard
Route::get('/alertdashboard', function () {
    return view('Users.alertdashboard');
});

//Administrator Routes

// Login
Route::get('/administrator', function () {
    return view('adminlogin');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('Admin.dashboard');
});