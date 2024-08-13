<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Home
Route::get('/', fn () => Inertia::render('Home'))->middleware('guest')->name('home');

Route::middleware('auth')->group(function () {
    // Books
    Route::get('/books', [BookController::class, 'index'])->name('books');
    Route::get('/books/add', [BookController::class, 'create'])->name('books.add');
    Route::get('/books/edit/{book}', [BookController::class, 'edit'])->name('books.edit');
    Route::post('/books/add', [BookController::class, 'store']);
    Route::put('/books/edit/{book}', [BookController::class, 'update']);
    Route::delete('/books/{book}', [BookController::class, 'destroy']);

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update']);
    Route::delete('/profile', [ProfileController::class, 'destroy']);

    // Logout
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
    Route::get('/logout')->middleware('guest'); // prevent direct access to this route if NOT authenticated
});

// Auth stuff
// TODO: Cleanup
// registration
Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest');
Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');

// session
Route::get('/login', [LoginController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'store'])->middleware('guest');

// password reset
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');
Route::get('/reset-password')->middleware('guest'); // prevent direct access to this route if authenticated
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');
Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.store');
