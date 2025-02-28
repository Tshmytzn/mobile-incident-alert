<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::post('/admin-login', action: [AdminController::class, 'login']);

Route::post('/admin-logout', action: [AdminController::class, 'logout']);

Route::post('/admin-picture-update', action: [AdminController::class, 'UpdateAdminPicture']);

Route::post('/update-admin', action: [AdminController::class, 'UpdateAdmin']);

Route::get('/get-admin', action: [AdminController::class, 'GetAdminProfile']);

Route::post('/add-user', action: [AdminController::class, 'AddUser']);

Route::get('/get-user', action: [AdminController::class, 'GetUser']);

Route::post('/update-user', action: [AdminController::class, 'UpdateUser']);

//RESPONDER MANAGEMENT
Route::post('/add-responder', action: [AdminController::class, 'AddResponder']);

Route::get('/get-responder', action: [AdminController::class, 'GetResponder']);

Route::post('/update-responder', action: [AdminController::class, 'UpdateResponder']);
