<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');



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
