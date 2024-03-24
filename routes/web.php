<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/departments', [HomeController::class, 'view_products']);
Route::get('/category/{id}', [HomeController::class, 'view_department']);
Route::get('/category/group/{id}', [HomeController::class, 'view_group'])->name('subgroup');

Route::get('/category/group/subgroup/{id}', [HomeController::class, 'view_subgroup_products'])->name('subgroup.products');
Route::get('/product_details/{id}', [HomeController::class, 'product_details']);
Route::post('/add_cart/{id}', [HomeController::class, 'add_cart']);
Route::get('/show_cart', [HomeController::class, 'show_cart']);


//show register form
Route::get('/register', [HomeController::class, 'register']);

//create new user
Route::post('/customer', [HomeController::class, 'store']);

//logout
Route::post('/logout', [HomeController::class, 'logout']);

//show login form
Route::get('/login', [HomeController::class, 'login']);

//login user
Route::post('/customer/authenticate', [HomeController::class, 'authenticate']);
