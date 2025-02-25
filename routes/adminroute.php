<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::post('/admin-login', action: [AdminController::class, 'login']);

Route::post('/add-user', action: [AdminController::class, 'AddUser']);

Route::get('/get-user', action: [AdminController::class, 'GetUser']);

Route::post('/update-user', action: [AdminController::class, 'UpdateUser']);
