<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BookController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', fn () => Inertia::render('Home'))->name('Home');

Route::get('/books', [BookController::class, 'index']);
Route::post('/books', [BookController::class, 'store']);
Route::get('/books/add', [BookController::class, 'add']);

Route::get('/register', fn () => Inertia::render('Auth/Register'));
Route::post('/register', function () {
    $attributes = request()->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255'],
        'password' => ['required', 'min:8'],
    ]);

    User::create($attributes);

    return redirect('/');
});

Route::get('/login', fn () => Inertia::render('Auth/Login'));
Route::post('/login', [LoginController::class, 'store']);
