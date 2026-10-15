<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminOrAgent
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        // If the logged-in user is a regular customer/user, deny admin panel access
        if (Auth::user()->role === 'user') {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Access restricted: The Administrative Agency Portal is reserved for authorized agents and underwriters.',
                ], 403);
            }

            return redirect()->route('dashboard')
                ->with('error', 'Access restricted: The Administrative Agency Portal is reserved for authorized agents and underwriters.');
        }

        return $next($request);
    }
}
