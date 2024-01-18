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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
