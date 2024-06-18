<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
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
        }


        return $next($request);
    }
}
