<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\AdminLog;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            abort(401, 'Unauthenticated');
        }

        $user = auth()->user();

        // Check if user has admin role (supporting both role and user_type)
        if (!$user->isAdmin()) {
            // Log unauthorized access attempt
            AdminLog::create([
                'admin_id' => $user->id,
                'action' => 'unauthorized_access_attempt',
                'details' => json_encode([
                    'user_id' => $user->id,
                    'email' => $user->email,
                    'role' => $user->role,
                    'user_type' => $user->user_type,
                    'ip' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'url' => $request->fullUrl()
                ]),
                'ip' => $request->ip()
            ]);

            abort(403, 'Access denied. Admin privileges required.');
        }

        // Log successful admin access
        AdminLog::create([
            'admin_id' => $user->id,
            'action' => 'admin_access',
            'details' => json_encode([
                'url' => $request->fullUrl(),
                'method' => $request->method(),
                'user_agent' => $request->userAgent()
            ]),
            'ip' => $request->ip()
        ]);

        return $next($request);
    }
} 