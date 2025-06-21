<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\AdminLog;

class AuthenticatedSessionController extends Controller
{
    /**
     * Show the login page.
     */
    public function create(Request $request): Response
    {
        return Inertia::render('auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => $request->session()->get('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = auth()->user();
        
        // Log successful login
        if ($user->isAdmin()) {
            AdminLog::create([
                'admin_id' => $user->id,
                'action' => 'admin_login',
                'details' => json_encode([
                    'login_time' => now()->toISOString(),
                    'ip' => $request->ip(),
                    'user_agent' => $request->userAgent()
                ]),
                'ip' => $request->ip()
            ]);
        }
        
        // Role-based redirection
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard')->with('success', 'Welcome back, Admin!');
        } elseif ($user->isCompany()) {
            return redirect()->route('company.dashboard');
        } else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = auth()->user();
        
        // Log logout
        if ($user && $user->isAdmin()) {
            AdminLog::create([
                'admin_id' => $user->id,
                'action' => 'admin_logout',
                'details' => json_encode([
                    'logout_time' => now()->toISOString(),
                    'ip' => $request->ip()
                ]),
                'ip' => $request->ip()
            ]);
        }

        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
