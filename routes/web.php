<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CompanyController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

// Info route toevoegen
Route::get('/info', function () {
    return Inertia::render('Info');
})->name('info');

// ✨ NIEUWE AFSPRAAK ROUTES
Route::get('/afspraak', function () {
    // Mock data voor bedrijven en tijdslots
    $bedrijven = [
        [
            'id' => 'microsoft',
            'naam' => 'Microsoft Belgium',
            'beschrijving' => 'Tech giant met focus op cloud computing, AI en enterprise solutions.',
            'tags' => ['Cloud', 'AI', 'Enterprise']
        ],
        [
            'id' => 'accenture',
            'naam' => 'Accenture',
            'beschrijving' => 'Global consultancy diensten in technologie en digitale transformatie.',
            'tags' => ['Consulting', 'Digital', 'Innovation']
        ],
        [
            'id' => 'deloitte',
            'naam' => 'Deloitte Digital',
            'beschrijving' => 'Digitale innovatie en consultancy voor enterprise klanten.',
            'tags' => ['Digital', 'Strategy', 'Tech']
        ],
        [
            'id' => 'proximus',
            'naam' => 'Proximus',
            'beschrijving' => 'Telecom leader met focus op 5G, IoT en digitale services.',
            'tags' => ['Telecom', '5G', 'IoT']
        ],
        [
            'id' => 'colruyt',
            'naam' => 'Colruyt Group IT',
            'beschrijving' => 'Retail technologie en e-commerce innovaties.',
            'tags' => ['Retail', 'E-commerce', 'Innovation']
        ],
        [
            'id' => 'bnp-paribas',
            'naam' => 'BNP Paribas Fortis',
            'beschrijving' => 'Internationale bank met focus op digitale banking en fintech.',
            'tags' => ['Banking', 'Fintech', 'Digital']
        ],
        [
            'id' => 'capgemini',
            'naam' => 'Capgemini',
            'beschrijving' => 'Technology consulting en digitale transformatie specialist.',
            'tags' => ['Consulting', 'Technology', 'Digital']
        ],
        [
            'id' => 'delaware',
            'naam' => 'delaware',
            'beschrijving' => 'IT consultancy gespecialiseerd in Microsoft technologieën.',
            'tags' => ['Microsoft', 'Consulting', 'Cloud']
        ]
    ];

    $tijdslots = [
        ['id' => '1', 'tijd' => '09:00 - 09:15', 'info' => '25 maart 2025', 'beschikbaar' => true],
        ['id' => '2', 'tijd' => '09:20 - 09:35', 'info' => '25 maart 2025', 'beschikbaar' => true],
        ['id' => '3', 'tijd' => '09:40 - 09:55', 'info' => '25 maart 2025', 'beschikbaar' => false],
        ['id' => '4', 'tijd' => '10:00 - 10:15', 'info' => '25 maart 2025', 'beschikbaar' => true],
        ['id' => '5', 'tijd' => '10:20 - 10:35', 'info' => '25 maart 2025', 'beschikbaar' => true],
        ['id' => '6', 'tijd' => '10:40 - 10:55', 'info' => '25 maart 2025', 'beschikbaar' => false],
        ['id' => '7', 'tijd' => '11:00 - 11:15', 'info' => '25 maart 2025', 'beschikbaar' => true],
        ['id' => '8', 'tijd' => '11:20 - 11:35', 'info' => '25 maart 2025', 'beschikbaar' => true],
        ['id' => '9', 'tijd' => '13:00 - 13:15', 'info' => '25 maart 2025', 'beschikbaar' => true],
        ['id' => '10', 'tijd' => '13:20 - 13:35', 'info' => '25 maart 2025', 'beschikbaar' => false],
        ['id' => '11', 'tijd' => '13:40 - 13:55', 'info' => '25 maart 2025', 'beschikbaar' => true],
        ['id' => '12', 'tijd' => '14:00 - 14:15', 'info' => '25 maart 2025', 'beschikbaar' => true],
        ['id' => '13', 'tijd' => '14:20 - 14:35', 'info' => '25 maart 2025', 'beschikbaar' => true],
        ['id' => '14', 'tijd' => '14:40 - 14:55', 'info' => '25 maart 2025', 'beschikbaar' => false],
        ['id' => '15', 'tijd' => '15:00 - 15:15', 'info' => '25 maart 2025', 'beschikbaar' => true],
        ['id' => '16', 'tijd' => '15:20 - 15:35', 'info' => '25 maart 2025', 'beschikbaar' => true]
    ];

    $studierichtingen = [
        'Multimedia & Creatieve Technologie',
        'Toegepaste Informatica',
        'Internet of Things',
        'Industrieel Ingenieur',
        'Grafische en Digitale Media',
        'Business Management',
        'Marketing',
        'International Business',
        'Anders'
    ];

    return Inertia::render('Afspraak', [
        'bedrijven' => $bedrijven,
        'tijdslots' => $tijdslots,
        'studierichtingen' => $studierichtingen
    ]);
})->name('afspraak');

// POST route voor afspraak verwerking
Route::post('/afspraak', function () {
    // Validatie van afspraak data
    $validated = request()->validate([
        'bedrijf' => 'required|string',
        'tijdslot' => 'required|string',
        'voornaam' => 'required|string|max:255',
        'achternaam' => 'required|string|max:255',
        'email' => 'required|email',
        'telefoon' => 'nullable|string',
        'studierichting' => 'required|string',
        'notities' => 'nullable|string|max:1000'
    ]);

    // Hier zou je de afspraak opslaan in database
    // En bevestigingsmail versturen
    
    // Voor nu simuleren we een succesvolle opslag
    \Log::info('Nieuwe afspraak ingepland:', $validated);
    
    return response()->json([
        'success' => true,
        'message' => 'Afspraak succesvol ingepland!',
        'data' => $validated
    ], 201);
})->name('afspraak.store');

// Favorieten route met mock data
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

Route::get('/contact', function () {
    return Inertia::render('Contact'); // 'Contact' verwijst naar Contact.vue
})->name('contact');

Route::get('/home', function () {
    return Inertia::render('Welcome');
})->name('home.alt');

// API routes voor favorieten functionaliteit
Route::delete('/favorites/{id}', function ($id) {
    // Simuleer het verwijderen van een favoriet
    // In een echte app zou je dit uit de database verwijderen
    return response()->json(['message' => 'Favoriet verwijderd'], 200);
})->name('favorites.destroy');

Route::post('/favorites', function () {
    // Simuleer het toevoegen van een favoriet
    // In een echte app zou je dit opslaan in de database
    return response()->json(['message' => 'Favoriet toegevoegd'], 201);
})->name('favorites.store');

// Routes voor profiel bekijken (voor de buttons in favorieten cards)
Route::get('/studenten/{id}', function ($id) {
    return Inertia::render('StudentProfile', ['studentId' => $id]);
})->name('student.show');

Route::get('/bedrijven/{id}', function ($id) {
    return Inertia::render('CompanyProfile', ['companyId' => $id]);
})->name('company.show');

Route::get('/profielen/{id}', function ($id) {
    return Inertia::render('Profile', ['profileId' => $id]);
})->name('profile.show');

// Route voor berichten (voor bericht button)
Route::get('/berichten/nieuw', function () {
    return Inertia::render('NewMessage', [
        'to' => request('to'),
        'type' => request('type')
    ]);
})->name('messages.create');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Registration routes
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');

// Dedicated route voor bedrijven registratie
Route::get('/register-bedrijf', function () {
    return Inertia::render('auth/Register-bedrijf');
})->name('register.bedrijf');

// Company profile routes
Route::post('/bedrijf/profiel/update', [CompanyController::class, 'update'])->name('company.profile.update');

// Bedrijfsprofielpagina tonen
Route::get('/bedrijf/profiel', function () {
    return Inertia::render('profielpaginabedrijf');
})->name('company.profile');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';