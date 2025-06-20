<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $favorites = $user->favorites()
            ->with('favoritable')
            ->where('favoritable_type', User::class)
            ->get()
            ->map(function ($favorite) {
                return $favorite->favoritable;
            });

        $recentBedrijven = User::bedrijven()
            ->active()
            ->latest()
            ->take(6)
            ->get(['id', 'name', 'company_name', 'email']);

        return Inertia::render('Student/Dashboard', [
            'user' => $user,
            'favorites' => $favorites,
            'recentBedrijven' => $recentBedrijven,
            'stats' => [
                'total_favorites' => $favorites->count(),
                'profile_views' => rand(10, 50), // Mock data
                'applications_sent' => rand(2, 15), // Mock data
            ]
        ]);
    }

    public function toggleFavorite(Request $request)
    {
        $request->validate([
            'favoritable_id' => 'required|integer|exists:users,id',
            'favoritable_type' => 'required|string'
        ]);

        $user = auth()->user();
        $favorite = Favorite::where([
            'user_id' => $user->id,
            'favoritable_id' => $request->favoritable_id,
            'favoritable_type' => $request->favoritable_type
        ])->first();

        if ($favorite) {
            $favorite->delete();
            $action = 'removed';
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'favoritable_id' => $request->favoritable_id,
                'favoritable_type' => $request->favoritable_type
            ]);
            $action = 'added';
        }

        return back()->with('message', "Favoriet {$action}!");
    }
} 