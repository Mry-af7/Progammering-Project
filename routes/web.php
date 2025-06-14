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

Route::get('/afspraak', function () {
    return Inertia::render('Afspraak');
})->name('afspraak');

Route::get('/favorieten', function () {
    return Inertia::render('Favorieten');
})->name('favorieten');

Route::get('/bedrijven', function () {
    return Inertia::render('Bedrijven');
})->name('bedrijven');

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('register/bedrijf', [RegisteredUserController::class, 'createBedrijf'])->name('register.bedrijf');
    Route::post('register/bedrijf', [RegisteredUserController::class, 'storeBedrijf']);
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

Route::get('/home', function () {
    return redirect('/');
})->name('home');