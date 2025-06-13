<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Favorite;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\DB;

class FavorietenController extends Controller
{
    public function index()
    {
        $favorites = auth()->user()->favorites()
            ->with(['favoritable'])
            ->latest()
            ->get()
            ->map(function ($favorite) {
                if (!$favorite->favoritable) {
                    // Optioneel: verwijder orphaned favorite
                    // $favorite->delete();
                    return null;
                }

                return [
                    'id' => $favorite->id,
                    'item_id' => $favorite->favoritable_id,
                    'item_type' => $favorite->favoritable_type,
                    'title' => $favorite->favoritable->name ?? $favorite->favoritable->title ?? 'Onbekend',
                    'description' => $favorite->favoritable->description ?? null,
                    'image_url' => $favorite->favoritable->logo_url ?? $favorite->favoritable->avatar_url ?? null,
                    'created_at' => $favorite->created_at
                ];
            })
            ->filter(); // Verwijder nulls

        return Inertia::render('Favorieten', [
            'favorites' => $favorites
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|integer',
            'item_type' => 'required|string|in:bedrijf,student,profiel'
        ]);

        // Check if the favoritable exists
        $modelClass = match($request->item_type) {
            'bedrijf' => \App\Models\Company::class,
            'student', 'profiel' => \App\Models\User::class,
            default => null
        };

        if (!$modelClass || !$modelClass::find($request->item_id)) {
            return back()->with('error', 'Het geselecteerde item bestaat niet meer.');
        }

        $existingFavorite = auth()->user()->favorites()
            ->where('favoritable_id', $request->item_id)
            ->where('favoritable_type', $request->item_type)
            ->first();

        if ($existingFavorite) {
            return back()->with('error', 'Dit item staat al in je favorieten');
        }

        try {
            DB::beginTransaction();

            $favorite = auth()->user()->favorites()->create([
                'favoritable_id' => $request->item_id,
                'favoritable_type' => $request->item_type
            ]);

            DB::commit();

            return back()->with('success', 'Item succesvol toegevoegd aan favorieten');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Er is een fout opgetreden bij het toevoegen van het favoriet.');
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $favorite = auth()->user()->favorites()->findOrFail($id);
            $favorite->delete();

            DB::commit();

            return back()->with('success', 'Favoriet succesvol verwijderd');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Er is een fout opgetreden bij het verwijderen van het favoriet.');
        }
    }
}
