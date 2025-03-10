<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResponderController;
use App\Http\Controllers\AlertController;



Route::post('/responder-login', action: [ResponderController::class, 'login']);

Route::post('/responder-logout', action: [ResponderController::class, 'logout']);

Route::Get('/responder-profile', action: [ResponderController::class, 'GetProfile']);

Route::post('/responder-password-update', action: [ResponderController::class, 'UpdateResponderPassword']);

Route::post('/responder-profile-update', action: [ResponderController::class, 'UpdateProfile']);

Route::get('/get-alert-for-responder', action: [AlertController::class, 'GetAlertsForResponder']);

Route::get('/responder-get-report', action: [ResponderController::class, 'GetResponderReports']);

Route::post('/confirm-alert-for-responder', action: [AlertController::class, 'ConfirmAlert']);
