<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::post('/user-login', action: [UserController::class, 'login']);

Route::post('/user-logout', action: [UserController::class, 'logout']);

Route::Get('/user-profile', action: [UserController::class, 'GetProfile']);

Route::post('/user-picture-update', action: [UserController::class, 'UpdateProfilePicture']);

Route::post('/user-profile-update', action: [UserController::class, 'UpdateProfile']);