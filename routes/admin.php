<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MasterDataController;
use App\Http\Controllers\Admin\UploadImageController;

Route::get('/master-data', [MasterDataController::class, 'show'])->name('masterData');
Route::post('/upload-image', [UploadImageController::class, 'upload'])->name('uploadImage');

Route::group(['as' => 'auth.', 'prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/me', [AuthController::class, 'me'])->name('me');
    Route::post('/profile', [AuthController::class, 'updateProfile'])->name('updateProfile');
    Route::post('/change-password', [AuthController::class, 'changePassword'])->name('changePassword');
});

Route::group(['as' => 'users.', 'prefix' => 'users'], function () {
    Route::get('/', [UserController::class, 'list'])->name('list');
    Route::get('/{user}', [UserController::class, 'detail'])->name('detail');
    Route::post('/{user}', [UserController::class, 'update'])->name('update');
});
