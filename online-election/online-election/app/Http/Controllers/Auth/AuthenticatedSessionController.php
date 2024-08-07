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
    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = auth()->user();
            //dd($user->role);
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'shareholder':
                case 'candidate':
                case 'bod':
                case 'employee':
                    return redirect()->route('member.dashboard');
                default:
                    return abort(403, 'Unauthorized access');
            }
        }

        // Authentication failed
       return back()->withErrors([
        'username' => 'The provided credentials do not match our records.',
        ]);
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
