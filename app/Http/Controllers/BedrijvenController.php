<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BedrijvenController extends Controller
{
    public function index()
    {
        $bedrijven = Company::where('is_active', true)
            ->select(['id', 'name', 'logo_path', 'website', 'specialisatie', 'beschrijving', 'adres', 'telefoon', 'email'])
            ->get();

        return Inertia::render('Bedrijven', [
            'bedrijven' => $bedrijven
        ]);
    }

    public function show($id)
    {
        $bedrijf = Company::findOrFail($id);
        return Inertia::render('BedrijfDetail', [
            'bedrijf' => $bedrijf
        ]);
    }
} 