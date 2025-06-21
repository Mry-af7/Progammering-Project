<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileOnboardingController;
use App\Http\Controllers\CompanyOnboardingController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\JobManagementController;
use App\Http\Controllers\Admin\ContentManagementController;
use App\Http\Controllers\Admin\SystemSettingsController;
use Illuminate\Foundation\Application;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::get('/home', function () {
    return Inertia::render('Welcome');
});

Route::get('/info', function () {
    return Inertia::render('Info');
})->name('info');

Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');

Route::get('/bedrijven', function () {
    return Inertia::render('Bedrijven');
})->name('bedrijven');

Route::get('/favorieten', function () {
    return Inertia::render('Favorieten');
})->name('favorieten');

Route::get('/afspraak', function () {
    return Inertia::render('Afspraak');
})->name('afspraak');

Route::get('/students', function () {
    return Inertia::render('Students/Index');
})->name('students');

Route::get('/wiezijnwe', function () {
    return Inertia::render('wiezijnwe');
})->name('wiezijnwe');

Route::get('/faq', function () {
    return Inertia::render('Faq');
})->name('faq');

/*
|--------------------------------------------------------------------------
| API Routes for Favorites (Mock Data)
|--------------------------------------------------------------------------
*/

Route::delete('/favorites/{id}', function ($id) {
    // Simuleer het verwijderen van een favoriet
    return response()->json(['message' => 'Favoriet verwijderd'], 200);
})->name('favorites.destroy');

Route::post('/favorites', function () {
    // Simuleer het toevoegen van een favoriet
    return response()->json(['message' => 'Favoriet toegevoegd'], 201);
})->name('favorites.store');

/*
|--------------------------------------------------------------------------
| Profile Viewing Routes
|--------------------------------------------------------------------------
*/

Route::get('/studenten/{id}', function ($id) {
    return Inertia::render('StudentProfile', ['studentId' => $id]);
})->name('student.show');

Route::get('/bedrijven/{id}', function ($id) {
    return Inertia::render('CompanyProfile', ['companyId' => $id]);
})->name('company.show');

Route::get('/profielen/{id}', function ($id) {
    return Inertia::render('Profile', ['profileId' => $id]);
})->name('profile.show');

/*
|--------------------------------------------------------------------------
| Messaging Routes
|--------------------------------------------------------------------------
*/

Route::get('/berichten/nieuw', function () {
    return Inertia::render('NewMessage', [
        'to' => request('to'),
        'type' => request('type')
    ]);
})->name('messages.create');

/*
|--------------------------------------------------------------------------
| Company Routes (Public)
|--------------------------------------------------------------------------
*/

Route::get('/bedrijf/profiel', function () {
    return Inertia::render('profielpaginabedrijf');
})->name('company.profile');

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    // Student registration
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    
    // Company registration - SIMPLIFIED: Use same form route, just different display
    Route::get('register/bedrijf', [RegisteredUserController::class, 'createBedrijf'])->name('register.bedrijf');
    // Company registration now uses the SAME POST route as students: /register
    
    // Login
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.update');
});

/*
|--------------------------------------------------------------------------
| Protected Routes (Auth Required)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {
    
    // Logout
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    
    // Main Dashboard - FIXED: Handle admins first, then user types
    Route::get('/dashboard', function () {
        $user = auth()->user();
        
        // ADMINS bypass all onboarding and go straight to admin dashboard
        if ($user->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        
        // Regular users: check onboarding completion
        if ($user->user_type === 'company') {
            // Check if company profile is complete, if not redirect to onboarding
            if (!$user->company || !$user->company->is_complete) {
                return redirect()->route('company.onboarding');
            }
            return redirect()->route('company.dashboard');
        } else {
            // Student users
            if (!$user->profile_completed) {
                return redirect()->route('profile-onboarding');
            }
            return app(DashboardController::class)->index();
        }
    })->name('dashboard');
    
    // Student Profile Onboarding Routes (Step-by-step completion)
    Route::get('/profile-onboarding', [ProfileOnboardingController::class, 'index'])->name('profile-onboarding');
    Route::get('/profile-onboarding/step/{step}', [ProfileOnboardingController::class, 'showStep'])->name('profile-onboarding.step');
    
    Route::post('/profile-onboarding/basic-info', [ProfileOnboardingController::class, 'storeBasicInfo'])->name('profile-onboarding.basic-info');
    Route::post('/profile-onboarding/github-portfolio', [ProfileOnboardingController::class, 'storeGitHubPortfolio'])->name('profile-onboarding.github-portfolio');
    Route::post('/profile-onboarding/skills', [ProfileOnboardingController::class, 'storeSkills'])->name('profile-onboarding.skills');
    Route::post('/profile-onboarding/languages', [ProfileOnboardingController::class, 'storeLanguages'])->name('profile-onboarding.languages');
    Route::post('/profile-onboarding/hobbies', [ProfileOnboardingController::class, 'storeHobbies'])->name('profile-onboarding.hobbies');
    Route::post('/profile-onboarding/complete', [ProfileOnboardingController::class, 'complete'])->name('profile-onboarding.complete');

    // Company Onboarding Routes (Individual routes like student onboarding)
    Route::get('/company/onboarding', [CompanyOnboardingController::class, 'index'])->name('company.onboarding');
    Route::get('/company/onboarding/step/{step}', [CompanyOnboardingController::class, 'showStep'])->name('company.onboarding.step');
    Route::get('/company/onboarding/{step}', [CompanyOnboardingController::class, 'showStep'])->name('company.onboarding.show');
    
    Route::post('/company/onboarding/basics', [CompanyOnboardingController::class, 'storeBasics'])->name('company.onboarding.basics');
    Route::post('/company/onboarding/details', [CompanyOnboardingController::class, 'storeDetails'])->name('company.onboarding.details');
    Route::post('/company/onboarding/tech', [CompanyOnboardingController::class, 'storeTech'])->name('company.onboarding.tech');
    Route::post('/company/onboarding/benefits', [CompanyOnboardingController::class, 'storeBenefits'])->name('company.onboarding.benefits');
    Route::post('/company/onboarding/media', [CompanyOnboardingController::class, 'storeMedia'])->name('company.onboarding.media');
    Route::post('/company/onboarding/complete', [CompanyOnboardingController::class, 'complete'])->name('company.onboarding.complete');

    // Company Dashboard & Management
    Route::prefix('company')->name('company.')->group(function () {
        Route::get('/dashboard', [CompanyController::class, 'dashboard'])->name('dashboard');
        
        // Add these new routes for saving students
        Route::post('/save-student', [CompanyController::class, 'saveStudent'])->name('save-student');
        Route::delete('/unsave-student', [CompanyController::class, 'unsaveStudent'])->name('unsave-student');
        
        Route::get('/profile-management', function () {
            return Inertia::render('Company/ProfileManagement');
        })->name('profile.management');
    });
    
    // Regular Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Protected) - UPDATED
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', App\Http\Middleware\AdminMiddleware::class])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        // Main admin dashboard - UPDATED to use controller
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        
        // Company approval routes - NEW
        Route::post('/companies/{company}/approve', [AdminDashboardController::class, 'approveCompany'])->name('companies.approve');
        Route::post('/companies/{company}/reject', [AdminDashboardController::class, 'rejectCompany'])->name('companies.reject');
        
        // User management routes - NEW
        Route::get('/users/{user}/edit', [UserManagementController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserManagementController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserManagementController::class, 'destroy'])->name('users.destroy');
        
        // Job management routes - NEW
        Route::get('/jobs', [JobManagementController::class, 'index'])->name('jobs.index');
        Route::get('/jobs/{job}', [JobManagementController::class, 'show'])->name('jobs.show');
        Route::put('/jobs/{job}', [JobManagementController::class, 'update'])->name('jobs.update');
        Route::delete('/jobs/{job}', [JobManagementController::class, 'destroy'])->name('jobs.destroy');
        
        // Content management routes - NEW
        Route::get('/content', [ContentManagementController::class, 'index'])->name('content.index');
        Route::put('/content', [ContentManagementController::class, 'update'])->name('content.update');
        
        // System settings routes - NEW
        Route::get('/settings', [SystemSettingsController::class, 'index'])->name('settings.index');
        Route::put('/settings', [SystemSettingsController::class, 'update'])->name('settings.update');
        
        // Existing admin routes (kept as they were)
        Route::get('/users', function () {
            return Inertia::render('Admin/Users');
        })->name('users');
        
        Route::get('/analytics', function () {
            return Inertia::render('Admin/Analytics');
        })->name('analytics');
        
        Route::get('/companies', function () {
            return Inertia::render('Admin/Companies');
        })->name('companies');
        
        Route::get('/appointments', function () {
            return Inertia::render('Admin/Appointments');
        })->name('appointments');
        
        // API routes for admin actions (kept as they were)
        Route::post('/users/{user}/promote', function ($userId) {
            $user = \App\Models\User::findOrFail($userId);
            $user->promoteToAdmin(auth()->user());
            return response()->json(['message' => 'User promoted to admin successfully']);
        })->name('users.promote');
        
        Route::delete('/users/{user}/revoke-admin', function ($userId) {
            $user = \App\Models\User::findOrFail($userId);
            $user->revokeAdmin();
            return response()->json(['message' => 'Admin access revoked successfully']);
        })->name('users.revoke-admin');
    });
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
    ];
    
    return response()->view('sitemap', compact('urls'))
        ->header('Content-Type', 'text/xml');
})->name('sitemap');

// === LEGACY REDIRECTS ===
Route::redirect('/appointment', '/afspraak', 301);
Route::redirect('/appointments', '/afspraken', 301);
Route::redirect('/booking', '/afspraak', 301);