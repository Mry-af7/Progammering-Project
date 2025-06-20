<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\BedrijfDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Public routes
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::get('/info', fn() => Inertia::render('Info'))->name('info');
Route::get('/bedrijven', fn() => Inertia::render('Bedrijven'))->name('bedrijven');
Route::get('/contact', fn() => Inertia::render('Contact'))->name('contact');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    
    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
    
    // Password Reset Routes...
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/favorieten', fn() => Inertia::render('Favorieten'))->name('favorieten');
    
    // Role-specific dashboards
    Route::get('student/dashboard', [StudentDashboardController::class, 'index'])
        ->middleware('role:student')->name('student.dashboard');
    
    Route::get('bedrijf/dashboard', [BedrijfDashboardController::class, 'index'])
        ->middleware('role:bedrijf')->name('bedrijf.dashboard');

    Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])
        ->middleware('role:admin')->name('admin.dashboard');

    // Other authenticated routes
    Route::post('favorites/toggle', [StudentDashboardController::class, 'toggleFavorite'])
        ->name('favorites.toggle');

    Route::get('bedrijf/studenten/search', [BedrijfDashboardController::class, 'searchStudents'])
        ->middleware('role:bedrijf')->name('bedrijf.studenten.search');

    Route::get('admin/users', [AdminDashboardController::class, 'users'])
        ->middleware('role:admin')->name('admin.users');
        
    Route::patch('admin/users/{user}/toggle-status', [AdminDashboardController::class, 'toggleUserStatus'])
        ->middleware('role:admin')->name('admin.users.toggle-status');

    // Fallback dashboard route
    Route::get('dashboard', function () {
        $user = auth()->user();
        if (!$user) return redirect()->route('login');
        return redirect($user->getDashboardRoute());
    })->name('dashboard');
});