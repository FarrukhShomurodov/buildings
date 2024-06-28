<?php

use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth', 'admin'], function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', [UserController::class, 'index'])->name('users');
    Route::resource('/users', UserController::class);

    Route::get('/floors-by-house/{house}', [FloorController::class, 'byHouse']);

    Route::resource('/houses', HouseController::class);
    Route::resource('/floors', FloorController::class);
    Route::resource('/apartments', ApartmentController::class);
});
