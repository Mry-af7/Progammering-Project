<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use App\Models\Student;
use App\Models\Job;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'totalUsers' => User::count(),
            'totalStudents' => Student::count(),
            'totalCompanies' => Company::count(),
            'pendingApprovals' => Company::where('status', 'pending')->count(),
            'newUsersThisMonth' => User::whereMonth('created_at', Carbon::now()->month)->count(),
            'activeJobPostings' => Job::where('status', 'active')->count(),
        ];

        return Inertia::render('Admin/Dashboard', [
            'stats' => $stats,
            'recentStudents' => Student::with('user')->latest()->take(5)->get(),
            'recentCompanies' => Company::with('user')->latest()->take(5)->get(),
            'pendingCompanies' => Company::where('status', 'pending')->take(5)->get(),
            'recentJobs' => Job::with('company')->latest()->take(5)->get(),
            'recentActivity' => $this->getRecentActivity(),
        ]);
    }

    public function approveCompany(Company $company)
    {
        $company->update(['status' => 'approved']);
        return back()->with('success', 'Company approved successfully');
    }

    public function rejectCompany(Company $company)
    {
        $company->update(['status' => 'rejected']);
        return back()->with('success', 'Company rejected');
    }

    private function getRecentActivity()
    {
        // Implement your activity logging logic here
        return [
            ['id' => 1, 'description' => 'New company registered', 'time' => '2 hours ago'],
            ['id' => 2, 'description' => 'Student updated profile', 'time' => '4 hours ago'],
        ];
    }
}