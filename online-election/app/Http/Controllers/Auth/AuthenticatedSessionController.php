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

            // Redirect based on user role
            return $this->redirectBasedOnRole();
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Determine the redirect path based on the user's role.
     */
    protected function redirectBasedOnRole()
    {
        $user = Auth::user();

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
    public function adminDashboard()
    {
        return view('ui/production/index2'); // Replace with your admin dashboard view
    }

    /**
     * Redirect to the member dashboard.
     */
    public function memberDashboard()
    {
        return view('ui/production/index');// Replace with your member dashboard view
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
