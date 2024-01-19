<?php

use App\Http\Controllers\Auth\LoginController;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', fn() => Inertia::render('Home'))->name('Home');

Route::get('/books', fn() => Inertia::render('Books/Index'));
Route::post('/books', function () {
    $attributes = request()->validate([
        'title' => ['required', 'string', 'max:255'],
        'author' => ['required', 'string', 'max:255'],
        'pages' => ['required', 'integer'],
        'genre' => ['required', 'string', 'max:255'],
        'publishDate' => ['required', 'date'],
        'read' => ['required', 'boolean'],
    ]);

    Book::create($attributes);

    return redirect('/books');
});

Route::get('/add-book', function () {
    return Inertia::render('Books/Create');
});

Route::get('/register', fn() => Inertia::render('Auth/Register'));
Route::post('/register', function () {
    $attributes = request()->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255'],
        'password' => ['required', 'min:8'],
    ]);

    User::create($attributes);

    return redirect('/');
});

Route::get('/login', fn() => Inertia::render('Auth/Login'));
Route::post('/login', [LoginController::class, 'store']);