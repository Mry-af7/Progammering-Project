<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AfspraakController;
use App\Http\Controllers\FavorietenController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserActivityController;
use App\Http\Controllers\NotificationController;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// === PUBLIC ROUTES ===

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('/info', function () {
    return Inertia::render('Info');
})->name('info');

Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');

Route::get('/home', function () {
    return Inertia::render('Welcome');
})->name('home.alt');

// === AUTH ROUTES ===
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// === AFSPRAAK ROUTES ===
Route::get('/afspraak', [AfspraakController::class, 'index'])->name('afspraak');
Route::post('/afspraak', [AfspraakController::class, 'store'])->name('afspraak.store');
Route::get('/api/afspraak/tijdslots', [AfspraakController::class, 'getTimeSlots'])->name('api.afspraak.tijdslots');

// === FAVORIETEN ROUTES ===
Route::middleware(['auth'])->group(function () {
    Route::get('/favorieten', [FavorietenController::class, 'index'])->name('favorieten');
    Route::post('/favorites', [FavorietenController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/{id}', [FavorietenController::class, 'destroy'])->name('favorites.destroy');
});

// === PROFILE ROUTES ===
Route::get('/studenten/{id}', function ($id) {
    return Inertia::render('StudentProfile', ['studentId' => $id]);
})->name('student.show');

Route::get('/bedrijven/{id}', function ($id) {
    return Inertia::render('CompanyProfile', ['companyId' => $id]);
})->name('company.show');

Route::get('/profielen/{id}', function ($id) {
    return Inertia::render('Profile', ['profileId' => $id]);
})->name('profile.show');

// === MESSAGES ROUTES ===
Route::get('/berichten/nieuw', function () {
    return Inertia::render('NewMessage', [
        'to' => request('to'),
        'type' => request('type')
    ]);
})->name('messages.create');

// === PROTECTED ROUTES ===
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile Management
    Route::get('/profile', function () {
        return Inertia::render('Profile/Edit');
    })->name('profile.edit');
    
    Route::patch('/profile', function () {
        // Handle profile update
    })->name('profile.update');
    
    // Messages
    Route::get('/berichten', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/berichten/{id}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/berichten', [MessageController::class, 'store'])->name('messages.store');
    
    // Applications
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::post('/applications', [ApplicationController::class, 'store'])->name('applications.store');
    
    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    
    // User Activities
    Route::get('/activities', [UserActivityController::class, 'index'])->name('activities.index');
    
    // Quick Actions
    Route::post('/quick-actions/favorite', [FavorietenController::class, 'store'])->name('quick-actions.favorite');
    Route::post('/quick-actions/message', [MessageController::class, 'quickMessage'])->name('quick-actions.message');
    Route::post('/quick-actions/apply', [ApplicationController::class, 'quickApply'])->name('quick-actions.apply');
    
    // File Uploads
    Route::post('/upload/cv', function () {
        return response()->json(['success' => true, 'message' => 'CV uploaded successfully']);
    })->name('upload.cv');
    
    Route::post('/upload/portfolio', function () {
        return response()->json(['success' => true, 'message' => 'Portfolio uploaded successfully']);
    })->name('upload.portfolio');
    
    Route::post('/upload/profile-image', function () {
        return response()->json(['success' => true, 'message' => 'Profile image uploaded successfully']);
    })->name('upload.profile-image');
    
    // Real-time Updates
    Route::get('/live/appointments-count', function () {
        $controller = new AfspraakController();
        return response()->json([
            'tijdslots' => $controller->getBeschikbareTijdslots(),
            'timestamp' => now()->toISOString()
        ]);
    })->name('live.appointments-count');
});

// === CAREER LAUNCH SPECIFIC ROUTES ===
Route::prefix('career-launch')->name('career-launch.')->group(function () {
    Route::get('/', function () {
        return Inertia::render('CareerLaunch/Index');
    })->name('index');
    
    Route::get('/program', function () {
        return Inertia::render('CareerLaunch/Program');
    })->name('program');
    
    Route::get('/companies', function () {
        return Inertia::render('CareerLaunch/Companies');
    })->name('companies');
    
    Route::get('/schedule', function () {
        return Inertia::render('CareerLaunch/Schedule');
    })->name('schedule');
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

//voor registratie bedrijf;
use App\Http\Controllers\Auth\RegisteredUserController;
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');

// AL DEDICATED ROUTE VOOR BEDRIJVEN
Route::get('/register-bedrijf', function () {
    return Inertia::render('auth/Register-bedrijf');
})->name('register.bedrijf');
Route::get('/faq', function () {
    return Inertia::render('Faq');
});