<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class LoginController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Auth/Login');
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            $request->session()->flash('success', "Welcome back, {$user->name}!");

            if ($request->input('remember')) {
                return redirect()->route('books')->withCookie('remember', true, 60 * 24 * 30);
            }

            return to_route('books');
        }

        return back()->withErrors([
            'password' => 'Incorrect email or password.',
        ]);
    }

    public function destroy()
    {
        Auth::logout();

        return Inertia::location(route('home'));
    }
}
