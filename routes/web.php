<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BookController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', fn () => Inertia::render('Home'))->name('Home');
Route::get('/books', [BookController::class, 'index']);
Route::get('/books/add', [BookController::class, 'add']);
Route::post('/books/add', [BookController::class, 'store']);
Route::get('/books/edit/{book}', [BookController::class, 'edit']);
Route::patch('/books/edit', [BookController::class, 'update']);
Route::delete('/books/{book}', [BookController::class, 'destroy']);

Route::get('/register', fn () => Inertia::render('Auth/Register'));
Route::post('/register', function () {
    $attributes = request()->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255'],
        'password' => ['required', 'min:8', 'confirmed'],
    ]);

    User::create($attributes);

    return redirect('/');
});

Route::get('/login', fn () => Inertia::render('Auth/Login'));
Route::post('/login', [LoginController::class, 'store']);

Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
