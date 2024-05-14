<?php

use Illuminate\Support\Facades\Route;
use App\Infrastructure\Http\Controllers\AuthController;
use App\Infrastructure\Http\Controllers\BookController;
use App\Infrastructure\Http\Controllers\StoreController;
use App\Infrastructure\Http\Controllers\BookStoreController;
use App\Infrastructure\Http\Middleware\ForceJsonResponse;


Route::group(['middleware' => ForceJsonResponse::class], function() {
    Route::post('login', [AuthController::class, 'login']);
    
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
        
        Route::resource('books', BookController::class);
        Route::resource('stores', StoreController::class);
        
        Route::post('book-store/{book}/{store}', [BookStoreController::class, 'add']);
        Route::delete('book-store/{book}/{store}', [BookStoreController::class, 'remove']);
    });
});
