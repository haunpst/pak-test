<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\ProductApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('auth/login', [AuthApiController::class, 'login']);
Route::post('auth/logout', [AuthApiController::class, 'logout']);

Route::middleware('auth.jwt')->group(function () {

    // Category
    Route::get('/category/get', [CategoryApiController::class, 'index']);

    // Product
    Route::get('/product/get/{categoryId?}', [ProductApiController::class, 'index']);
    Route::post('/product/store', [ProductApiController::class, 'store']);
});
