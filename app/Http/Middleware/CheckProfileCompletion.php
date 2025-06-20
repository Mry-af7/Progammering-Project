<?php
// app/Http/Middleware/CheckProfileCompletion.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckProfileCompletion
{
    public function handle(Request $request, Closure $next, $minimumPercentage = 70)
    {
        $student = auth()->user();

        if ($student && $student->shouldShowOnboarding()) {
            // Don't redirect if already on profile completion pages
            if (!$request->routeIs('profile.*')) {
                return redirect()->route('profile.complete');
            }
        }

        return $next($request);
    }
}