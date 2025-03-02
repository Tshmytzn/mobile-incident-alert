<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlertController;


Route::post('/user-login', action: [UserController::class, 'login']);

Route::post('/user-logout', action: [UserController::class, 'logout']);

Route::Get('/user-profile', action: [UserController::class, 'GetProfile']);

Route::post('/user-picture-update', action: [UserController::class, 'UpdateProfilePicture']);

Route::post('/user-profile-update', action: [UserController::class, 'UpdateProfile']);

Route::post('/user-contact-update', action: [UserController::class, 'UpdateContact']);

Route::post('/user-send-alert', action: [AlertController::class, 'SendAlert']);

Route::post('/user-send-manual-alert', action: [AlertController::class, 'SendManualAlert']);

Route::Get('/user-get-alert', action: [AlertController::class, 'GetAlertsByUser']);