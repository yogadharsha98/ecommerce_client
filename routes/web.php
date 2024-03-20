<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/departments', [HomeController::class, 'view_products']);
Route::get('/category/{id}', [HomeController::class, 'view_department']);
Route::get('/category/group/{id}', [HomeController::class, 'view_group'])->name('subgroup');
Route::get('/cart', [HomeController::class, 'showCart'])->name('cart');

Route::get('/category/group/subgroup/{id}', [HomeController::class, 'view_subgroup_products'])->name('subgroup.products');
