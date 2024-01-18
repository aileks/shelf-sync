<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
});

Route::get('/books', function () {
    return Inertia::render('Books/Index');
});

Route::get('/add-book', function () {
    return Inertia::render('Books/Create');
});

Route::get('/register', function () {
    return Inertia::render('Auth/Register');
});

Route::get('Login', function () {
    return Inertia::render('Auth/Login');
});

require __DIR__ . '/auth.php';
