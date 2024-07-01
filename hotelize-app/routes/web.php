<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CepController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => HandleInertiaRequests::class], function () {
    Route::get('/', function () {
        return redirect()->route('hotels.index');
    });

    //Login
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('autenticar');

    //Users
    Route::resource('users', UserController::class)->only(['create', 'store']);

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::resource('hotels', HotelController::class)->except(['create']);
        Route::resource('hotels.rooms', RoomController::class)->except(['index', 'create', 'show'])->shallow();
        Route::resource('users', UserController::class)->except(['create', 'store']);

        Route::group(['prefix' => 'api', 'as' => 'api.'], function () {
            Route::get('cep/{cep?}/', [CepController::class, 'getCepInfo'])->name('cep');
        });
    });
});
