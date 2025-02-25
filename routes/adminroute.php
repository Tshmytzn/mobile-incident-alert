<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::post('/admin-login', action: [AdminController::class, 'login']);

Route::post('/add-user', action: [AdminController::class, 'AddUser']);

Route::get('/get-user', action: [AdminController::class, 'GetUser']);

Route::post('/update-user', action: [AdminController::class, 'UpdateUser']);

//RESPONDER MANAGEMENT
Route::post('/add-responder', action: [AdminController::class, 'AddResponder']);

Route::get('/get-responder', action: [AdminController::class, 'GetResponder']);

Route::post('/update-responder', action: [AdminController::class, 'UpdateResponder']);
