<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BookController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Home
Route::get('/', fn () => Inertia::render('Home'))->name('Home');

// Books stuff
Route::get('/books', [BookController::class, 'index']);
Route::get('/books/add', [BookController::class, 'add']);
Route::post('/books/add', [BookController::class, 'store']);
Route::get('/books/edit/{book}', [BookController::class, 'edit']);
Route::patch('/books/edit/{book}', [BookController::class, 'update']);
Route::delete('/books/{book}', [BookController::class, 'destroy']);

// Profile stuff
Route::get('/profile', fn () => Inertia::render('Profile/Index', ['name' => Auth::user()->name]));

// Auth stuff
Route::get('/register', fn () => Inertia::render('Auth/Register'));
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/login', fn () => Inertia::render('Auth/Login'));
Route::post('/login', [LoginController::class, 'store']);
Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
