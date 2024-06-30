<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CepController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

//Login
Route::post('login', [AuthController::class, 'login']);

Route::get('csrf', function () {
    return response()->json(['csrf' => csrf_token()]);
});

Route::group(['middleware' => ['auth']], function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::resource('hotels', HotelController::class)->except('create', 'edit');
    Route::resource('hotels.rooms', RoomController::class)->except('create', 'edit')->shallow();

    Route::group(['prefix' => 'api', 'as' => 'api.'], function () {
        Route::get('cep/{cep}', [CepController::class, 'getCepInfo'])->name('cep');
    });
});
