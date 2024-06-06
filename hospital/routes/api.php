<?php

use App\Http\Controllers\Api\Doctor\AuthController;
use App\Http\Controllers\Api\Doctor\SurgeryController;
use Illuminate\Support\Facades\Route;

// login
Route::name('api')->prefix('doctor')->middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('doctor.login');
});

//logout
Route::name('api')->prefix('doctor')->middleware('auth:doctor-api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('doctor.logout');

//surgeries
    Route::get('/surgeries', [SurgeryController::class, 'index'])->name('surgeries.index');
    Route::get('/surgeries/{id}', [SurgeryController::class, 'show'])->name('surgeries.show');
});

