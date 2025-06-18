<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Company\DashboardController as CompanyDashboardController;
use App\Http\Controllers\Company\OverviewController as CompanyOverviewController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\DashboardController;
use Illuminate\Foundation\Application;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Admin\AdminController;

// Public routes
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::get('/info', function () {
    return Inertia::render('Info');
})->name('info');

Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');

Route::get('/bedrijven', [CompanyOverviewController::class, 'index'])->name('bedrijven');
Route::get('/bedrijven/{id}', [CompanyOverviewController::class, 'show'])->name('bedrijven.show');

Route::get('/favorieten', function () {
    return Inertia::render('Favorieten');
})->name('favorieten');

Route::get('/afspraak', function () {
    return Inertia::render('Afspraak');
})->name('afspraak');

Route::get('/students', [StudentDashboardController::class, 'index'])->name('students');
Route::get('/students/{student}', [StudentDashboardController::class, 'show'])->name('students.show');
Route::get('/students/{student}/edit', [StudentDashboardController::class, 'edit'])->name('students.edit');
Route::put('/students/{student}', [StudentDashboardController::class, 'update'])->name('students.update');

Route::get('/wiezijnwe', function () {
    return Inertia::render('wiezijnwe');
})->name('wiezijnwe');

Route::get('/faq', function () {
    return Inertia::render('Faq');
})->name('faq');

// Auth routes
Route::middleware('guest')->group(function () {
    // Student registration
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    
    // Company registration
    Route::get('register/bedrijf', [RegisteredUserController::class, 'createBedrijf'])->name('register.bedrijf');
    Route::post('register/bedrijf', [RegisteredUserController::class, 'storeBedrijf']);
    
    // Login
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Company dashboard route
    Route::get('/company/dashboard', function () {
        return Inertia::render('Companies/Dashboard');
    })->name('company.dashboard');
});

// Admin routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/companies', [AdminController::class, 'companies'])->name('companies');
    Route::get('/students', [AdminController::class, 'students'])->name('students');
    Route::get('/appointments', [AdminController::class, 'appointments'])->name('appointments');
});

// Redirect na admin login
Route::middleware(['auth', 'admin'])->get('/admin', function () {
    return redirect()->route('admin.dashboard');
});

// Load other route files
require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

// === WEBHOOK ROUTES ===
Route::post('/webhooks/email-opened/{notification}', function ($notificationId) {
    // Track email opens
    DB::table('email_tracking')
        ->where('notification_id', $notificationId)
        ->update(['opened_at' => now()]);
        
    return response('OK');
})->name('webhooks.email-opened');

Route::post('/webhooks/email-clicked/{notification}', function ($notificationId) {
    // Track email clicks
    DB::table('email_tracking')
        ->where('notification_id', $notificationId)
        ->update(['clicked_at' => now()]);
        
    return response('OK');
})->name('webhooks.email-clicked');

// === SYSTEM HEALTH ROUTES ===
Route::get('/health', function () {
    return response()->json([
        'status' => 'healthy',
        'timestamp' => now()->toISOString(),
        'services' => [
            'database' => DB::connection()->getPdo() ? 'healthy' : 'unhealthy',
            'afspraak_system' => 'healthy'
        ]
    ]);
})->name('health');

// === ERROR PAGES ===
Route::get('/404', function () {
    return Inertia::render('Error', ['status' => 404]);
})->name('404');

Route::get('/500', function () {
    return Inertia::render('Error', ['status' => 500]);
})->name('500');

// === SITEMAP ===
Route::get('/sitemap.xml', function () {
    $urls = [
        ['url' => route('home'), 'priority' => '1.0'],
        ['url' => route('info'), 'priority' => '0.8'],
        ['url' => route('afspraak'), 'priority' => '0.9'],
        ['url' => route('contact'), 'priority' => '0.7'],
        ['url' => route('career-launch.index'), 'priority' => '0.8'],
    ];
    
    return response()->view('sitemap', compact('urls'))
        ->header('Content-Type', 'text/xml');
})->name('sitemap');

// === LEGACY REDIRECTS ===
Route::redirect('/appointment', '/afspraak', 301);
Route::redirect('/appointments', '/afspraken', 301);
Route::redirect('/booking', '/afspraak', 301);