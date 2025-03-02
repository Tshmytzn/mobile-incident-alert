<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResponderController;
use App\Http\Controllers\AlertController;



Route::post('/responder-login', action: [ResponderController::class, 'login']);

Route::post('/responder-logout', action: [ResponderController::class, 'logout']);

Route::Get('/responder-profile', action: [ResponderController::class, 'GetProfile']);

Route::post('/responder-picture-update', action: [ResponderController::class, 'UpdateProfilePicture']);

Route::post('/responder-password-update', action: [ResponderController::class, 'UpdateresponderPassword']);

Route::post('/responder-profile-update', action: [ResponderController::class, 'UpdateProfile']);
