<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Authentication required'], 401);
            }
            return redirect()->route('login')->with('error', 'Please log in to access admin area.');
        }

        // Check if user is admin
        if (!auth()->user()->is_admin) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Admin access required'], 403);
            }
            return redirect()->route('dashboard')->with('error', 'Admin access required.');
        }

        // Log admin access for security
        \Log::info('Admin access granted', [
            'user_id' => auth()->id(),
            'user_email' => auth()->user()->email,
            'route' => $request->route()->getName(),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        return $next($request);
    }
}