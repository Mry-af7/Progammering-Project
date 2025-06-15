<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::with(['timeSlots' => function ($query) {
            $query->where('start_time', '>', now())
                  ->where('is_available', true)
                  ->orderBy('start_time');
        }])->get();

        if (request()->wantsJson()) {
            return response()->json(['companies' => $companies]);
        }

        return Inertia::render('Companies/Index', [
            'companies' => $companies
        ]);
    }

    public function show(Company $company)
    {
        $company->load(['timeSlots' => function ($query) {
            $query->where('start_time', '>', now())
                  ->where('is_available', true)
                  ->orderBy('start_time');
        }]);

        if (request()->wantsJson()) {
            return response()->json(['company' => $company]);
        }

        return Inertia::render('Companies/Show', [
            'company' => $company
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'website' => 'nullable|url|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'logo' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('company-logos', 'public');
            $validated['logo_path'] = $path;
        }

        $company = Company::create($validated);

        return redirect()->route('companies.show', $company)
            ->with('success', 'Company created successfully.');
    }

    public function update(Request $request, Company $company)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'website' => 'nullable|url|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'logo' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('company-logos', 'public');
            $validated['logo_path'] = $path;
        }

        $company->update($validated);

        return redirect()->route('companies.show', $company)
            ->with('success', 'Company updated successfully.');
    }

    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('companies.index')
            ->with('success', 'Company deleted successfully.');
    }
} 