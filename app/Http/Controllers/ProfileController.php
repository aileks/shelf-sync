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
  /**
   * Renders the main profile page.
   * @param Request $request The GET request for the profile page.
   * @return Response The Inertia response to render the profile page.
   */
  public function index(Request $request): Response
  {
    return Inertia::render('Profile/Index', [
      'user' => $request->user()->only('name', 'email'),
      'books' => $request->user()->books()->get(),
    ]);
  }

  /**
   * TODO: Implement
   * Validates input and then updates the user's info in the database.
   * @param Request $request The POST request to update the user's info.
   * @return RedirectResponse The redirect response to the profile page.
   */
  public function update(Request $request): RedirectResponse
  {
    $user = $request->user();

    $data = $request->validate([
      'email' => ['required', 'string', 'email', 'max:255'],
      'currentPassword' => ['required'],
      'confirmEmail' => ['required', 'email', 'same:email'],
    ]);

    if (isset($data['currentPassword']) && !Hash::check($data['currentPassword'], $user->password)) {
      return back()->withErrors(['currentPassword' => "The provided password doesn't match our records."]);
    }

    unset($data['currentPassword']);

    $user->update($data);

    return back()->with('success', 'Profile updated.');
  }

  /**
   * Deletes a users account and information from the database.
   * Logs the users out, invalidates the session, and regenerates the CSRF token.
   * Book deletion is handled by the User model.
   * @param Request $request The DELETE request to delete the user's account.
   * @return RedirectResponse The redirect response to the home page.
   */
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
