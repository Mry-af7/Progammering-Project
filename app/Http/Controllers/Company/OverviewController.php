<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OverviewController extends Controller
{
    public function index()
    {
        $bedrijven = Company::where('is_active', true)
            ->select(['id', 'name', 'logo_path', 'website', 'specialisatie', 'beschrijving', 'adres', 'telefoon', 'email'])
            ->get();

        return Inertia::render('Companies/Overview', [
            'bedrijven' => $bedrijven
        ]);
    }

    public function show($id)
    {
        $bedrijf = Company::findOrFail($id);
        return Inertia::render('Companies/Detail', [
            'bedrijf' => $bedrijf
        ]);
    }
} 