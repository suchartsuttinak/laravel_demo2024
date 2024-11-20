<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\BackOfficeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureTokenIsValid;


Route::get('/', function () {
    return view('welcome');
});

//LogIn
Route::get('/user/signIn', [UserController::class, 'signIn']);
Route::post('/user/signInProcess', [UserController::class, 'signInProcess']);
Route::get('/user/signOut', [UserController::class, 'signOut'])->middleware(EnsureTokenIsValid::class);
Route::get('/user/info', [UserController::class, 'info'])->middleware(EnsureTokenIsValid::class);

Route::get('/backoffice', [BackOfficeController::class, 'index'])->middleware(EnsureTokenIsValid::class);


// Product
Route::get('/product/list', [ProductController::class, 'list']);
Route::get('/product/form', [ProductController::class, 'form']);
Route::post('/product', [ProductController::class, 'save']);
Route::get('/product/{id}', [ProductController::class, 'edit']);
Route::put('/product/{id}', [ProductController::class, 'update']);
Route::get('/product/remove/{id}', [ProductController::class, 'remove']);

//Search Product;
Route::post('/product/search', [ProductController::class, 'search']);

//คัดกรองข้อมูล
Route::get('/product-sort', [ProductController::class, 'sort']);
Route::get('/product-price-more-than', [ProductController::class, 'priceMoreThan']);
Route::get('/product-price-less-than', [ProductController::class, 'priceLessThan']);
Route::get('/product-pricebetween', [ProductController::class, 'priceBetween']);
Route::get('/product-notbetween', [ProductController::class, 'priceNotBetween']);
Route::get('/product-pricein', [ProductController::class, 'priceIn']);
Route::get('/product-max-min-count-avg', [ProductController::class, 'priceMaxMinCountAvg']);


//User Show
Route::get('/users/list', [UserController::class, 'list']);
Route::get('/users/form', [UserController::class, 'form']);
Route::post('/users', [UserController::class, 'create']);
Route::get('/users/{id}', [UserController::class, 'edit']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/remove/{id}', [UserController::class, 'remove']);