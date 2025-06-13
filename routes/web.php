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
use App\Http\Controllers\BedrijvenController;

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

// === AFSPRAAK ROUTES (Updated) ===
Route::get('/afspraak', [AfspraakController::class, 'index'])->name('afspraak');
Route::post('/afspraak', [AfspraakController::class, 'store'])->name('afspraak.store');

// Public API routes for afspraak (accessible without auth for checking availability)
Route::get('/api/afspraak/tijdslots', [AfspraakController::class, 'getTimeSlots'])->name('api.afspraak.tijdslots');

// === FAVORIETEN ROUTES ===
Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/favorieten', [FavorietenController::class, 'index'])->name('favorieten.index');
    Route::post('/favorites', [FavorietenController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/{id}', [FavorietenController::class, 'destroy'])->name('favorites.destroy');
});

// === PROFILE ROUTES ===
Route::get('/studenten/{id}', function ($id) {
    return Inertia::render('StudentProfile', ['studentId' => $id]);
})->name('student.show');

Route::get('/bedrijven', function () {
    return Inertia::render('Bedrijven');
})->name('bedrijven.index');

Route::get('/bedrijven/{id}', [BedrijvenController::class, 'show'])->name('bedrijven.show');

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

// === AUTHENTICATION ROUTES ===
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::get('/register-bedrijf', function () {
    return Inertia::render('auth/Register-bedrijf');
})->name('register.bedrijf');

// === PROTECTED ROUTES ===
Route::middleware(['auth', 'verified'])->group(function () {
    
    // === DASHBOARD ===
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::patch('/dashboard/tasks/{task}', [DashboardController::class, 'updateTask'])->name('dashboard.tasks.update');
    
    // === AFSPRAAK MANAGEMENT (Protected) ===
    Route::prefix('afspraken')->name('afspraken.')->group(function () {
        Route::get('/', [AfspraakController::class, 'getUserAppointments'])->name('index');
        Route::patch('/{id}/cancel', [AfspraakController::class, 'cancel'])->name('cancel');
        Route::patch('/{id}/reschedule', [AfspraakController::class, 'reschedule'])->name('reschedule');
        Route::get('/stats', [AfspraakController::class, 'getStats'])->name('stats');
    });
    
    // === PROFILE MANAGEMENT ===
    Route::get('/bedrijf/profiel', function () {
        return Inertia::render('profielpaginabedrijf');
    })->name('company.profile');
    
    Route::post('/bedrijf/profiel/update', [CompanyController::class, 'update'])->name('company.profile.update');
    
    // === APPLICATIONS ===
    Route::resource('applications', ApplicationController::class);
    Route::patch('/applications/{application}/status', [ApplicationController::class, 'updateStatus'])->name('applications.status');
    
    // === MESSAGES SYSTEM ===
    Route::get('/berichten', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/berichten/{conversation}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/berichten/{conversation}', [MessageController::class, 'store'])->name('messages.store');
    Route::patch('/berichten/{conversation}/read', [MessageController::class, 'markAsRead'])->name('messages.read');
    
    // === NOTIFICATIONS ===
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::patch('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::patch('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.read-all');
    Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    
    // === USER ACTIVITIES ===
    Route::get('/activities', [UserActivityController::class, 'index'])->name('activities.index');
    Route::patch('/activities/{activity}/read', [UserActivityController::class, 'markAsRead'])->name('activities.read');
    
    // === PROFILE ROUTES (Protected) ===
    Route::get('/profile', function () {
        $user = auth()->user()->load('studentProfile.studyField');
        return Inertia::render('Profile', ['user' => $user]);
    })->name('profile');
    
    Route::patch('/profile', function () {
        // Update profile logic here
        return back();
    })->name('profile.update');
    
    // === SEARCH & BROWSE ===
    Route::get('/studenten', function () {
        return Inertia::render('Studenten');
    })->name('studenten.index');
    
    Route::get('/bedrijven', function () {
        return Inertia::render('Bedrijven');
    })->name('bedrijven.index');
    
    // === EVENTS ===
    Route::get('/events', function () {
        return Inertia::render('EventsIndex');
    })->name('events.index');
    
    Route::get('/events/{event}', function ($event) {
        return Inertia::render('EventShow', ['eventId' => $event]);
    })->name('events.show');
    
    // === API ROUTES FOR AJAX CALLS ===
    Route::prefix('api')->name('api.')->group(function () {
        
        // === AFSPRAAK API ROUTES ===
        Route::prefix('afspraak')->name('afspraak.')->group(function () {
            Route::get('/user-appointments', [AfspraakController::class, 'getUserAppointmentsApi'])->name('user-appointments');
            Route::get('/stats', [AfspraakController::class, 'getStats'])->name('stats');
            Route::get('/companies', function () {
                $controller = new AfspraakController();
                return response()->json([
                    'companies' => $controller->getBedrijven()
                ]);
            })->name('companies');
            Route::get('/study-programs', function () {
                $controller = new AfspraakController();
                return response()->json([
                    'programs' => $controller->getStudierichtingen()
                ]);
            })->name('study-programs');
        });
        
        // Dashboard Data
        Route::get('/dashboard/stats', [DashboardController::class, 'getStats'])->name('dashboard.stats');
        Route::get('/dashboard/activities', [DashboardController::class, 'getActivities'])->name('dashboard.activities');
        Route::get('/dashboard/tasks', [DashboardController::class, 'getTasks'])->name('dashboard.tasks');
        
        // Profile Progress
        Route::get('/profile/progress', function () {
            $user = auth()->user();
            return response()->json([
                'completion_percentage' => $user->userStats?->profile_completion_percentage ?? 0,
                'sections' => [
                    'basic_info' => ['completed' => !empty($user->firstname) && !empty($user->email)],
                    'education' => ['completed' => !empty($user->studentProfile?->study_field_id)],
                    'skills' => ['completed' => !empty($user->studentProfile?->technical_skills)],
                    'portfolio' => ['completed' => !empty($user->studentProfile?->portfolio_url)]
                ]
            ]);
        })->name('profile.progress');
        
        // Search/Filter
        Route::get('/search/students', function () {
            // Return filtered students
            return response()->json(['students' => []]);
        })->name('search.students');
        
        Route::get('/search/companies', function () {
            // Return filtered companies
            return response()->json(['companies' => []]);
        })->name('search.companies');
        
        // Stats for charts
        Route::get('/stats/applications', function () {
            $user = auth()->user();
            $stats = $user->userStats;
            
            return response()->json([
                'total' => $stats?->applications_sent ?? 0,
                'pending' => $stats?->applications_pending ?? 0,
                'interview' => $stats?->applications_interview ?? 0,
                'offers' => $stats?->applications_offers ?? 0,
                'rejected' => $stats?->applications_rejected ?? 0
            ]);
        })->name('stats.applications');
        
        // Profile views over time
        Route::get('/stats/profile-views', function () {
            return response()->json([
                'total_views' => auth()->user()->userStats?->profile_views_count ?? 0,
                'this_month' => auth()->user()->userStats?->profile_views_this_month ?? 0,
                'daily_views' => [] // Array of daily view counts for charts
            ]);
        })->name('stats.profile-views');
        
        // Quick actions
        Route::post('/quick-actions/favorite', [FavorietenController::class, 'store'])->name('quick-actions.favorite');
        Route::post('/quick-actions/message', [MessageController::class, 'quickMessage'])->name('quick-actions.message');
        Route::post('/quick-actions/apply', [ApplicationController::class, 'quickApply'])->name('quick-actions.apply');
        
        // File uploads
        Route::post('/upload/cv', function () {
            // Handle CV upload
            return response()->json(['success' => true, 'message' => 'CV uploaded successfully']);
        })->name('upload.cv');
        
        Route::post('/upload/portfolio', function () {
            // Handle portfolio file upload
            return response()->json(['success' => true, 'message' => 'Portfolio uploaded successfully']);
        })->name('upload.portfolio');
        
        Route::post('/upload/profile-image', function () {
            // Handle profile image upload
            return response()->json(['success' => true, 'message' => 'Profile image uploaded successfully']);
        })->name('upload.profile-image');

        // Real-time updates
        Route::get('/live/appointments-count', function () {
            // Return current appointment counts for real-time updates
            $controller = new AfspraakController();
            return response()->json([
                'tijdslots' => $controller->getBeschikbareTijdslots(),
                'timestamp' => now()->toISOString()
            ]);
        })->name('live.appointments-count');
        
        // Calendar integration
        Route::get('/calendar/export/{appointmentId}', function ($appointmentId) {
            // Export appointment to calendar format
            $appointment = DB::table('appointments')
                ->where('id', $appointmentId)
                ->where('student_id', auth()->id())
                ->first();
                
            if (!$appointment) {
                abort(404);
            }
            
            // Generate ICS file content
            $icsContent = "BEGIN:VCALENDAR\nVERSION:2.0\nBEGIN:VEVENT\n";
            $icsContent .= "DTSTART:20250325T090000Z\n";
            $icsContent .= "DTEND:20250325T091500Z\n";
            $icsContent .= "SUMMARY:Career Launch Speeddate\n";
            $icsContent .= "DESCRIPTION:Speeddate met bedrijf\n";
            $icsContent .= "LOCATION:Erasmushogeschool Brussel, Campus Kaai\n";
            $icsContent .= "END:VEVENT\nEND:VCALENDAR";
            
            return response($icsContent)
                ->header('Content-Type', 'text/calendar')
                ->header('Content-Disposition', 'attachment; filename="speeddate.ics"');
        })->name('calendar.export');
    });
    
    // === ADMIN ROUTES (for company users) ===
    Route::middleware(['company'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return Inertia::render('admin/Dashboard');
        })->name('dashboard');
        
        Route::get('/applications', function () {
            return Inertia::render('admin/Applications');
        })->name('applications');
        
        Route::get('/students', function () {
            return Inertia::render('admin/Students');
        })->name('students');
        
        Route::get('/events', function () {
            return Inertia::render('admin/Events');
        })->name('events');
        
        // Appointment management for companies
        Route::prefix('appointments')->name('appointments.')->group(function () {
            Route::get('/', function () {
                return Inertia::render('admin/Appointments');
            })->name('index');
            
            Route::get('/export', function () {
                // Export appointments to Excel/CSV
                return response()->json(['message' => 'Export functionality to be implemented']);
            })->name('export');
            
            Route::patch('/{id}/notes', function ($id) {
                // Update company notes for appointment
                request()->validate(['notes' => 'required|string|max:1000']);
                
                DB::table('appointments')
                    ->where('id', $id)
                    ->update([
                        'company_notes' => request('notes'),
                        'updated_at' => now()
                    ]);
                    
                return response()->json(['success' => true]);
            })->name('update-notes');
        });
    });
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