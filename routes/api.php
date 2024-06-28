<?php

use App\Http\Controllers\Api\ApartmentController;
use App\Http\Controllers\Api\FloorController;
use Illuminate\Support\Facades\Route;


// Todo middlaware
Route::get('/floors-by-house/{house}', [FloorController::class, 'getFloorsByHouse']);
Route::delete('/delete/photos_url/{photoPath}/{apartment}', [ApartmentController::class, 'deletePhoto']);
