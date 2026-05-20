<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\MasterDataController;
use App\Http\Controllers\User\UploadImageController;

Route::get('/master-data', [MasterDataController::class, 'show'])->name('masterData');
Route::post('/upload-image', [UploadImageController::class, 'upload'])->name('uploadImage');

Route::group(['as' => 'auth.', 'prefix' => 'auth'], function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('resetPassword');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/me', [AuthController::class, 'me'])->name('me');
    Route::post('/profile', [AuthController::class, 'updateProfile'])->name('updateProfile');
    Route::post('/change-password', [AuthController::class, 'changePassword'])->name('changePassword');
});
