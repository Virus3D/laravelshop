<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\OrderController;

Route::get('/', [ShopController::class, 'index']);
Route::post('/add-to-cart', [ShopController::class, 'addToCart']);
Route::get('/checkout', [ShopController::class, 'checkout']);
Route::post('/place-order', [ShopController::class, 'placeOrder']);
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::post('/orders/{id}/delete', [OrderController::class, 'delete'])->name('orders.delete');

