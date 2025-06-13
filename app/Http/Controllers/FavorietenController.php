<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class FavorietenController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login')->withErrors('Je moet ingelogd zijn om je favorieten te bekijken.');
        }

        $favorites = $user->favorites()
            ->latest()
            ->get()
            ->map(function ($fav) {
                return [
                    'id' => $fav->id,
                    'title' => $fav->favoritable->title ?? 'Geen titel',
                    'description' => $fav->favoritable->description ?? 'Geen beschrijving',
                    'image_url' => $fav->favoritable->image_url ?? null,
                    'item_type' => $fav->favoritable_type,
                    'item_id' => $fav->favoritable_id,
                    'created_at' => $fav->created_at,
                ];
            });

        return Inertia::render('Favorieten', [
            'favorites' => $favorites
        ]);
    }
}
