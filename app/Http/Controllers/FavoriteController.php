<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Auth::user()->favorites()->with('favoritable')->get();

        return Inertia::render('Favorites/Index', [
            'favorites' => $favorites
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'favoritable_id' => 'required',
            'favoritable_type' => 'required|string',
        ]);

        // Ensure the type is a valid model
        $model = 'App\\Models\\' . ucfirst($request->favoritable_type);
        if (!class_exists($model)) {
            return back()->with('error', 'Invalid type provided.');
        }

        Auth::user()->favorites()->create([
            'favoritable_id' => $request->favoritable_id,
            'favoritable_type' => $model,
        ]);

        return back()->with('success', 'Toegevoegd aan favorieten.');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'favoritable_id' => 'required',
            'favoritable_type' => 'required|string',
        ]);

        $model = 'App\\Models\\' . ucfirst($request->favoritable_type);
        if (!class_exists($model)) {
            return back()->with('error', 'Invalid type provided.');
        }

        $favorite = Auth::user()->favorites()
            ->where('favoritable_id', $request->favoritable_id)
            ->where('favoritable_type', $model)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return back()->with('success', 'Verwijderd uit favorieten.');
        }

        return back()->with('error', 'Favoriet niet gevonden.');
    }
} 