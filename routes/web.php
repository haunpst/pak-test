<?php

use App\Http\Controllers\Web\AuthWebController;
use App\Http\Controllers\Web\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('login', [AuthWebController::Class, 'login'])->name('login');
Route::post('login', [AuthWebController::Class, 'login'])->name('login.post');
Route::get('logout', [AuthWebController::Class, 'logout'])->name('logout');
Route::get('register', [AuthWebController::Class, 'register'])->name('register');
Route::post('register', [AuthWebController::Class, 'register'])->name('register.post');


Route::middleware('auth:web')->group(function () {
    Route::get('', [ProductController::class, 'index'])->name('product.list');
    Route::get('product/store', [ProductController::class, 'store'])->name('product.store');
    Route::post('product/store', [ProductController::class, 'store'])->name('product.store.post');
    Route::get('product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit.put');
    Route::delete('product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
});

