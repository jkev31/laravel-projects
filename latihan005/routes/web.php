<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;





Route::get('/items', [ItemController::class, 'index']);
Route::post('/items', [ItemController::class, 'store']);
Route::put('/items', [ItemController::class, 'update']);
Route::delete('/items', [ItemController::class, 'destroy']);