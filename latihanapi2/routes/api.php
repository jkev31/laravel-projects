<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\KaryawanController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::get('/karyawans', [KaryawanController::class, 'index']);
Route::get('/karyawans/{id}', [KaryawanController::class, 'show']);
Route::post('/karyawans', [KaryawanController::class, 'store']);
Route::put('/karyawans/{id}', [KaryawanController::class, 'updatePut']);
Route::patch('/karyawans/{id}', [KaryawanController::class, 'updatePatch']);
Route::delete('/karyawans/{id}', [KaryawanController::class, 'destroy']);

Route::post('/karyawans/bonus', [KaryawanController::class, 'bonus']);