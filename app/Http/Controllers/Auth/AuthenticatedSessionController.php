<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Handle AJAX request
        if ($request->ajax()) {


          if (Auth::user()->hasRole('captain') || Auth::user()->hasRole('super-admin')) {
              return response()->json(['redirect' => route('dashboard')]);
          }

          if (Auth::user()->hasRole('member')) {
              session()->flash('success_registration', 'Login successfully');
              return response()->json(['redirect' => route('profile.index')]);
          }

          return response()->json(['redirect' => url('/')]);
        }

        // if (Auth::user()->hasRole('captain') || Auth::user()->hasRole('super-admin')) {
        //     return redirect()->route('dashboard'); // redirect to dashboard for admin/superadmin
        // }

        // if (Auth::user()->hasRole('member')) {
        //     return redirect()->route('profile.index')->with('success_registration', 'Login successfully'); // redirect to profile for member
        // }

        // // Default redirect if no specific role is matched
        // return redirect()->intended('/');

        // return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
