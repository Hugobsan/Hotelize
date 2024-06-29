<?php

use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/csrf', function () {
    return response()->json(['csrf' => csrf_token()]);
});

Route::resource('hotels', HotelController::class)->except('create', 'edit');
Route::resource('hotels.rooms', RoomController::class)->shallow();
