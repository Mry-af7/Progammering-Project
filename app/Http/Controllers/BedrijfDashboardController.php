<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BedrijfDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $studenten = User::students()
            ->active()
            ->with(['favorites' => function($query) use ($user) {
                $query->where('user_id', $user->id);
            }])
            ->paginate(12)
            ->through(function ($student) use ($user) {
                return [
                    'id' => $student->id,
                    'name' => $student->name,
                    'email' => $student->email,
                    'age' => $student->age,
                    'gender' => $student->gender,
                    'field_of_study' => $student->field_of_study,
                    'is_favorited' => $student->favorites->isNotEmpty(),
                    'created_at' => $student->created_at->format('d/m/Y'),
                ];
            });

        $totalStudents = User::students()->active()->count();
        $myFavorites = auth()->user()->favorites()
            ->where('favoritable_type', User::class)
            ->count();

        return Inertia::render('Bedrijf/Dashboard', [
            'user' => $user,
            'studenten' => $studenten,
            'stats' => [
                'total_students' => $totalStudents,
                'my_favorites' => $myFavorites,
                'profile_views' => rand(20, 100), // Mock data
            ]
        ]);
    }

    public function searchStudents(Request $request)
    {
        $query = User::students()->active();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('field_of_study', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('field_of_study')) {
            $query->where('field_of_study', 'like', "%{$request->field_of_study}%");
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        $studenten = $query->paginate(12)->withQueryString();

        return back()->with('studenten', $studenten);
    }
}
