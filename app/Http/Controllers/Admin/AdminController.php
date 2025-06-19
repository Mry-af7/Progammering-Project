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
        try {
            $stats = [
                'total_students' => User::where('role', 'student')->count(),
                'total_companies' => Company::count(),
                'total_appointments' => Appointment::count(),
                'pending_appointments' => Appointment::where('status', 'pending')->count(),
                'confirmed_appointments' => Appointment::where('status', 'confirmed')->count(),
            ];

            $recent_appointments = Appointment::with(['user', 'company'])
                ->latest()
                ->take(10)
                ->get();

            $recent_students = User::where('role', 'student')
                ->latest()
                ->take(10)
                ->get();

            return Inertia::render('Admin/Dashboard', [
                'stats' => $stats,
                'recent_appointments' => $recent_appointments,
                'recent_students' => $recent_students,
            ]);
        } catch (\Exception $e) {
            \Log::error('Admin Dashboard Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Er is een fout opgetreden bij het laden van het dashboard.');
        }
    }

    public function companies()
    {
        try {
            $companies = Company::withCount('appointments')
                ->paginate(15);

            return Inertia::render('Admin/Companies', [
                'companies' => $companies
            ]);
        } catch (\Exception $e) {
            \Log::error('Admin Companies Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Er is een fout opgetreden bij het laden van de bedrijven.');
        }
    }

    public function students()
    {
        try {
            $students = User::where('role', 'student')
                ->withCount('appointments')
                ->paginate(15);

            return Inertia::render('Admin/Students', [
                'students' => $students
            ]);
        } catch (\Exception $e) {
            \Log::error('Admin Students Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Er is een fout opgetreden bij het laden van de studenten.');
        }
    }

    public function appointments()
    {
        try {
            $appointments = Appointment::with(['user', 'company'])
                ->latest()
                ->paginate(15);

            return Inertia::render('Admin/Appointments', [
                'appointments' => $appointments
            ]);
        } catch (\Exception $e) {
            \Log::error('Admin Appointments Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Er is een fout opgetreden bij het laden van de afspraken.');
        }
    }
}
