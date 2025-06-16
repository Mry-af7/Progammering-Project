<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use Illuminate\Foundation\Application;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;

// Public routes
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/info', function () {
    return Inertia::render('Info');
})->name('info');

Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');

Route::get('/afspraak', [AppointmentController::class, 'index'])->name('afspraak');
Route::post('/afspraak', [AppointmentController::class, 'store'])->name('afspraak.store');
Route::get('/afspraak/{id}', [AppointmentController::class, 'show'])->name('afspraak.show');
Route::put('/afspraak/{id}', [AppointmentController::class, 'update'])->name('afspraak.update');
Route::delete('/afspraak/{id}', [AppointmentController::class, 'destroy'])->name('afspraak.destroy');
Route::get('/afspraak/{id}/download', [AppointmentController::class, 'downloadCalendar'])->name('afspraak.download');
Route::get('/afspraak/event/{eventId}/slots', [AppointmentController::class, 'getAvailableTimeSlots'])->name('afspraak.slots');

Route::get('/favorieten', function () {
    return Inertia::render('Favorieten');
})->name('favorieten');

Route::get('/bedrijven', function () {
    return Inertia::render('Bedrijven');
})->name('bedrijven');

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
    
    // Companies
    Route::get('/companies', function () {
        return Inertia::render('Bedrijven');
    })->name('companies.index');
    Route::get('/companies/{company}', [CompanyController::class, 'show'])->name('companies.show');
    Route::get('/alle-bedrijven', [CompanyController::class, 'index'])->name('companies.alle');
    
    // Company management (company users only)
    Route::middleware('company')->group(function () {
        Route::post('/companies', [CompanyController::class, 'store'])->name('companies.store');
        Route::put('/companies/{company}', [CompanyController::class, 'update'])->name('companies.update');
        Route::delete('/companies/{company}', [CompanyController::class, 'destroy'])->name('companies.destroy');
    });
    
    // Appointments
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show');
    
    // Appointment management (students only)
    Route::middleware('student')->group(function () {
        Route::get('/appointments/create/{company}', [AppointmentController::class, 'create'])->name('appointments.create');
        Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
        Route::put('/appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');
        Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
    });
    
    // Favorites (students only)
    Route::middleware('student')->group(function () {
        Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
        Route::post('/favorites', [FavoriteController::class, 'store'])->name('favorites.store');
        Route::delete('/favorites/{company}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
        Route::post('/favorites/{company}/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    });

    // Student routes
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/{student}', [StudentController::class, 'show'])->name('students.show');
    Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
});

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

// Load other route files
require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

Route::get('/debug-users', function () {
    $users = User::all(['email', 'firstname', 'lastname', 'role', 'user_type']);
    $output = "";
    foreach ($users as $user) {
        $output .= "Email: {$user->email}, Name: {$user->firstname} {$user->lastname}, Role: {$user->role}, Type: {$user->user_type}\n";
    }
    Storage::disk('local')->put('user_emails.txt', $output);
    return 'Dumped to storage/app/user_emails.txt';
});

// Admin dashboard route
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return Inertia::render('AdminDashboard');
    })->name('admin.dashboard');
});

Route::get('/alle-bedrijven', function () {
    return Inertia::render('Bedrijven');
})->name('bedrijven.index');


Route::get('/Wiezijnwe', function () {
    return Inertia::render('wiezijnwe');
})->name('Wiezijnwe');

Route::get('/home', function () {
    return redirect('/');
})->name('home');
