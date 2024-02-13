<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    public function show(Request $request): Response
    {
        return Inertia::render('Profile/Index', [
            'user' => $request->user()->only('name', 'email'),
            'books' => $request->user()->books()->get(),
        ]);
    }

    public function update(Request $request): Response
    {
        $user = $request->user();

        $data = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'currentPassword' => ['required'],
            'confirmEmail' => ['required', 'email', 'same:email'],
        ]);

        if (isset($data['currentPassword']) && ! Hash::check($data['currentPassword'], $user->password)) {
            return back()->withErrors(['currentPassword' => "The provided password doesn't match our records."]);
        }

        unset($data['currentPassword']);

        $user->update($data);

        return back()->with('success', 'Profile updated.');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $user = $request->user();

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $user->delete();

        return redirect(route('home'));
    }
}
