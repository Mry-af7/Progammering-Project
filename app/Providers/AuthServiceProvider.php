<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Appointment;
use App\Models\Company;
use App\Models\Favorite;
use App\Policies\AppointmentPolicy;
use App\Policies\CompanyPolicy;
use App\Policies\FavoritePolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Appointment::class => AppointmentPolicy::class,
        Company::class => CompanyPolicy::class,
        Favorite::class => FavoritePolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
} 