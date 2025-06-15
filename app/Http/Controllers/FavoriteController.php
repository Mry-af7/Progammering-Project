<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = auth()->user()->favorites()->with('company')->get();

        return Inertia::render('Favorites/Index', [
            'favorites' => $favorites
        ]);
    }

    public function store(Company $company)
    {
        auth()->user()->favorites()->syncWithoutDetaching([$company->id]);

        return back()->with('success', 'Bedrijf toegevoegd aan favorieten.');
    }

    public function destroy(Company $company)
    {
        auth()->user()->favorites()->detach($company->id);

        return back()->with('success', 'Bedrijf verwijderd uit favorieten.');
    }
} 