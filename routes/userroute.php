<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::post('/user-login', action: [UserController::class, 'login']);

Route::post('/user-logout', action: [UserController::class, 'logout']);