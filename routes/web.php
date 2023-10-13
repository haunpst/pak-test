<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('login', [AuthController::Class, 'login'])->name('login');
Route::post('login', [AuthController::Class, 'login'])->name('login.post');
Route::get('logout', [AuthController::Class, 'logout'])->name('logout');
Route::get('register', [AuthController::Class, 'register'])->name('register');
Route::post('register', [AuthController::Class, 'register'])->name('register.post');


Route::middleware('auth:web')->group(function () {
    Route::get('', [ProductController::class, 'index'])->name('product.list');
    Route::get('store', [ProductController::class, 'store'])->name('product.store');
    Route::post('store', [ProductController::class, 'store'])->name('product.store.post');
    Route::get('edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('edit/{id}', [ProductController::class, 'edit'])->name('product.edit.put');
    Route::delete('delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
});

