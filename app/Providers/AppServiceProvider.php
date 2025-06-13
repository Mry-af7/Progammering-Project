<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Professional morph map for favorites
        Relation::morphMap([
            'bedrijf' => \App\Models\Company::class,
            'student' => \App\Models\User::class, // adjust if you have a StudentProfile model
            'profiel' => \App\Models\User::class, // adjust if you have a StudentProfile model
        ]);
    }
}
