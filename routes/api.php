<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(['middleware' => 'api'], function () {

    Route::post('/register', [AuthController::class, 'register'])
        ->name('user.register');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('user.login');
    

});