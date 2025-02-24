<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::post('/save-data', action: [AdminController::class, 'login']);

