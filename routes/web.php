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

// Users Reports
Route::get('/alertdashboard', function () {
    return view('Users.alertdashboard');
});

// Users Reports
Route::get('/usersreports', function () {
    return view('Users.myreports');
});

// Notification
Route::get('/notification', function () {
    return view('Users.notification');
});

// Profile Settings
Route::get('/profilesettings', function () {
    return view('Users.profilesettings');
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

// User Management Page
Route::get('/users', function () {
    return view('Administrator.users');
});

// Incident Management Page
Route::get('/incidents', function () {
    return view('Administrator.incidents');
});

// Responder Management Page
Route::get('/responders', function () {
    return view('Administrator.responders');
});

// Reports Management Page
Route::get('/reports', function () {
    return view('Administrator.reports');
});

// Settings Page
Route::get('/settings', function () {
    return view('Administrator.settings');
});