<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Favorite;

class FavorietenController extends Controller
{
    public function index()
    {
        $favorites = auth()->user()
            ->favorites()
            ->latest()
            ->get()
            ->map(function ($fav) {
                return [
                    'id' => $fav->id,
                    'title' => $fav->title,
                    'description' => $fav->description,
                    'image_url' => $fav->image_url,
                    'item_type' => $fav->item_type,
                    'item_id' => $fav->item_id,
                    'created_at' => $fav->created_at,
                ];
            });

        return Inertia::render('Favorieten', [
            'favorites' => $favorites,
        ]);
    }

    public function destroy($id)
    {
        $favorite = auth()->user()->favorites()->findOrFail($id);
        $favorite->delete();

        return redirect()->route('favorieten')->with('message', 'Favoriet verwijderd.');
    }
}
