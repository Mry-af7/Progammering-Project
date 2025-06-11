<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

<<<<<<< HEAD


Route::get('dashboard', function () {
=======
// Info route toevoegen
Route::get('/info', function () {
    return Inertia::render('Info');
})->name('info');

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
});

Route::get('/home', function () {
    return Inertia::render('Welcome');
});

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
>>>>>>> 1d5321b4edd4559d3eda39ed4a923714f1369a55
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';