<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [ProductController::class, 'index']) ;
Route :: get ('/products/ {id}', [ProductController::class, 'show' ]) ;
Route::post ('/products', [ProductController::class, 'store']) ;
Route :: put('/products/{id}', [ProductController :: class, 'updatePut']);
Route::patch ('/products/ {id}', [ProductController::class, 'updatePatch']);
Route::delete ('/products/ {id}', [ProductController:: class, 'destroy']);

