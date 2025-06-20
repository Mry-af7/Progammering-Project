<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalStudents = User::students()->count();
        $totalBedrijven = User::bedrijven()->count();
        $totalFavorites = Favorite::count();
        
        $recentUsers = User::latest()->take(10)->get();
        $recentFavorites = Favorite::with(['user', 'favoritable'])
            ->latest()
            ->take(10)
            ->get();

        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'total_users' => $totalUsers,
                'total_students' => $totalStudents,
                'total_bedrijven' => $totalBedrijven,
                'total_favorites' => $totalFavorites,
            ],
            'recent_users' => $recentUsers,
            'recent_favorites' => $recentFavorites,
        ]);
    }

    public function users(Request $request)
    {
        $query = User::query();

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->latest()->paginate(20)->withQueryString();

        return Inertia::render('Admin/Users', [
            'users' => $users,
            'filters' => $request->only(['role', 'search'])
        ]);
    }

    public function toggleUserStatus(User $user)
    {
        $user->update(['is_active' => !$user->is_active]);
        
        return back()->with('message', 
            $user->is_active ? 'Gebruiker geactiveerd' : 'Gebruiker gedeactiveerd'
        );
    }
}
 