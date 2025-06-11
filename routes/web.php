<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('/favorieten', function () {
    return Inertia::render('Favorieten'); // 'Contact' verwijst naar Contact.vue
});


Route::get('/contact', function () {
    return Inertia::render('Contact'); // 'Contact' verwijst naar Contact.vue
});

Route::get('/home', function () {
    return Inertia::render('Welcome');
});


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

//voor registratie bedrijf;
use App\Http\Controllers\Auth\RegisteredUserController;
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');

// AL DEDICATED ROUTE VOOR BEDRIJVEN
Route::get('/register-bedrijf', function () {
    return Inertia::render('auth/Register-bedrijf');
})->name('register.bedrijf');
