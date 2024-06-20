<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Election;

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
    public function getElections()
{
  $user = Auth::user();

  // Default to retrieving all active elections
  $elections = Election::where('is_active', true);

  if ($user->role === 'admin') {
    // Admins can see all elections
    $elections; // No additional filtering needed
  } else {
    // Filter for elections relevant to other roles (shareholder, candidate, etc.)
    $elections=Election::whereIn('election_name',['bod','policy'])->get();
  }

  return $elections;
}

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
  $elections = $this->getElections();

        switch ($user->role) {
            case 'admin':
                return redirect('/index2');
            case 'shareholder':
            case 'candidate':
            case 'bod':
            case 'employee':
                session()->put('elections', $elections);
                 return redirect('/index');
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
