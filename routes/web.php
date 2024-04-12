<?php

use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/products', [HomeController::class, 'show_all_products']);

Route::get('/departments', [HomeController::class, 'view_products']);
Route::get('/category/{id}', [HomeController::class, 'view_department']);
Route::get('/category/group/{id}', [HomeController::class, 'view_group'])->name('subgroup');

Route::get('/category/group/subgroup/{id}', [HomeController::class, 'view_subgroup_products'])->name('subgroup.products');
Route::get('/product_details/{id}', [HomeController::class, 'product_details']);
Route::post('/add_cart/{id}', [HomeController::class, 'add_cart']);
Route::get('/show_cart', [HomeController::class, 'show_cart']);
Route::get('/remove_cart/{id}', [HomeController::class, 'remove_cart']);
Route::put('/update_cart/{id}', [HomeController::class, 'updateCart']);



Route::get('/show_order', [HomeController::class, 'show_order']);

Route::get('/cancel_order/{id}', [HomeController::class, 'cancel_order']);

Route::get('/product_search', [HomeController::class, 'product_search']);

//show srtipe
Route::get('/stripe/{total_amount}', [HomeController::class, 'stripe']);

//store payment
Route::post('stripe/{total_amount}', [HomeController::class, 'stripePost'])->name('stripe.post');

//contact
Route::get('/contactus', [HomeController::class, 'show_contact']);

//my account
Route::get('/myaccount', [HomeController::class, 'show_myaccount']);

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



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
