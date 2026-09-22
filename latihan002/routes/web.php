<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/halo', function () {
    return "halo laravel";
});

Route::get('/profil/{nama}', function ($nama) {
    return "nama saya " . $nama;
});

