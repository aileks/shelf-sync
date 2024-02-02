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
// Route::get('/profile/stats', fn () => Inertia::render('Profile/Stats'));
// Route::get('profile/settings', fn () => Inertia::render('Profile/Settings'));

// Auth stuff
Route::get('/register', fn () => Inertia::render('Auth/Register'));
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/login', fn () => Inertia::render('Auth/Login'));
Route::post('/login', [LoginController::class, 'store']);
Route::post('logout', [LoginController::class, 'destroy'])->name('logout');

// Database Test
Route::get('/test-database', function () {
    try {
        DB::connection()->getPdo();
        print_r("Connected successfully to: " . DB::connection()->getDatabaseName());
    } catch (\Exception $e) {
        die("Could not connect to the database.  Please check your configuration. Error:" . $e );
    }
});

