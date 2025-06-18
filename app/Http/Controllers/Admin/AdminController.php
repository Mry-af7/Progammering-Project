<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Geen toegang');
        }
        $stats = [
            'total_students' => User::where('is_admin', false)->count(),
            'total_companies' => Company::count(),
            'total_appointments' => Appointment::count(),
            'pending_appointments' => Appointment::where('status', 'pending')->count(),
            'confirmed_appointments' => Appointment::where('status', 'confirmed')->count(),
        ];

        $recent_appointments = Appointment::with(['user', 'company'])
            ->latest()
            ->take(10)
            ->get();

        $recent_students = User::where('is_admin', false)
            ->latest()
            ->take(10)
            ->get();

        return Inertia::render('Admin/Dashboard', [
            'stats' => $stats,
            'recent_appointments' => $recent_appointments,
            'recent_students' => $recent_students,
        ]);
    }

    public function companies()
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Geen toegang');
        }
        $companies = Company::withCount('appointments')
            ->paginate(15);

        return Inertia::render('Admin/Companies', [
            'companies' => $companies
        ]);
    }

    public function students()
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Geen toegang');
        }
        $students = User::where('is_admin', false)
            ->withCount('appointments')
            ->paginate(15);

        return Inertia::render('Admin/Students', [
            'students' => $students
        ]);
    }

    public function appointments()
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Geen toegang');
        }
        $appointments = Appointment::with(['user', 'company'])
            ->latest()
            ->paginate(15);

        return Inertia::render('Admin/Appointments', [
            'appointments' => $appointments
        ]);
    }
}
