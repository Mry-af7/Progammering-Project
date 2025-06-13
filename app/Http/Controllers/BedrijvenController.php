<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BedrijvenController extends Controller
{
    public function index()
    {
        $companies = Company::where('is_active', true)
            ->select(['id', 'name', 'industry', 'description', 'location', 'logo'])
            ->get();

        return Inertia::render('Bedrijven', [
            'companies' => $companies
        ]);
    }

    public function show($id)
    {
        $company = Company::with(['openPositions'])
            ->findOrFail($id);

        return Inertia::render('BedrijfProfiel', [
            'company' => $company
        ]);
    }
} 