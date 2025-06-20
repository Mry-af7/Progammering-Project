<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileOnboardingController;
use App\Http\Controllers\CompanyOnboardingController;
use App\Http\Controllers\CompanyController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return Inertia::render('Welcome');
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

/*
|--------------------------------------------------------------------------
| Favorites Routes (Mock Data)
|--------------------------------------------------------------------------
*/

Route::get('/favorieten', function () {
    // Mock favorieten data - vervang later met database
    $favorites = [
        [
            'id' => 1,
            'title' => 'Emma Janssens',
            'item_type' => 'student',
            'description' => 'Multimedia & Creatieve Technologie student met focus op UX/UI design en frontend development.',
            'image_url' => 'https://i.pravatar.cc/150?img=1',
            'item_id' => 1,
            'created_at' => now()->subDays(1)->toISOString()
        ],
        [
            'id' => 2,
            'title' => 'TechStartup Brussels',
            'item_type' => 'bedrijf',
            'description' => 'Innovatief fintech bedrijf op zoek naar getalenteerde developers en designers voor ons groeiende team.',
            'image_url' => 'https://i.pravatar.cc/150?img=2',
            'item_id' => 2,
            'created_at' => now()->subDays(3)->toISOString()
        ],
        [
            'id' => 3,
            'title' => 'Lars Van Der Berg',
            'item_type' => 'student',
            'description' => 'Internet of Things student gespecialiseerd in embedded systems en IoT architectuur.',
            'image_url' => 'https://i.pravatar.cc/150?img=3',
            'item_id' => 3,
            'created_at' => now()->subDays(5)->toISOString()
        ],
        [
            'id' => 4,
            'title' => 'Digital Agency Antwerp',
            'item_type' => 'bedrijf',
            'description' => 'Creatief digitaal bureau dat merken helpt groeien door middel van design en technologie.',
            'image_url' => 'https://i.pravatar.cc/150?img=4',
            'item_id' => 4,
            'created_at' => now()->subWeek()->toISOString()
        ],
        [
            'id' => 5,
            'title' => 'Sofia Rodriguez',
            'item_type' => 'student',
            'description' => 'Toegepaste Informatica student met passie voor AI, machine learning en data science.',
            'image_url' => 'https://i.pravatar.cc/150?img=5',
            'item_id' => 5,
            'created_at' => now()->subWeeks(2)->toISOString()
        ]
    ];
    
    return Inertia::render('Favorieten', [
        'favorites' => $favorites
    ]);
})->name('favorieten');

/*
|--------------------------------------------------------------------------
| API Routes for Favorites
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
| Registration Routes
|--------------------------------------------------------------------------
*/

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');

Route::get('/register-bedrijf', function () {
    return Inertia::render('auth/Register-bedrijf');
})->name('register.bedrijf');

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
| Protected Routes (Auth Required)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {
    
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
    
    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';