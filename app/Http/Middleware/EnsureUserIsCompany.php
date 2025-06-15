<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsCompany
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || !$request->user()->isCompany()) {
            return redirect()->route('dashboard')
                ->with('error', 'You must be a company to access this page.');
        }

        return $next($request);
    }
} 