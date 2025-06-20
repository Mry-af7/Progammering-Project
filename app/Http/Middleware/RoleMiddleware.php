<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $user = auth()->user();

        if (!$user->is_active) {
            auth()->logout();
            return redirect('/login')->with('error', 'Je account is gedeactiveerd.');
        }

        if (!in_array($user->role, $roles)) {
            // Redirect naar hun eigen dashboard
            return redirect($user->getDashboardRoute());
        }

        return $next($request);
    }
} 