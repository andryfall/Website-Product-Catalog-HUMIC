<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Homepage');
});

Route::get('/login', function () {
    return view('Login');
});

Route::get('/dashboard', function () {
    return view('Dashboard');
});

Route::get('/management', function () {
    return view('Management');
});