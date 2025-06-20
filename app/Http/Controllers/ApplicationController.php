<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Position;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::with(['position.company'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return Inertia::render('Applications/Index', [
            'applications' => $applications
        ]);
    }

    public function create(Request $request)
    {
        $position = Position::with(['company'])
            ->findOrFail($request->position);

        return Inertia::render('Applications/Create', [
            'position' => $position
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'position_id' => 'required|exists:positions,id',
            'cover_letter' => 'required|string',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:10240',
            'portfolio_url' => 'nullable|url'
        ]);

        $cvPath = $request->file('cv')->store('cvs', 'public');

        $application = Application::create([
            'user_id' => auth()->id(),
            'position_id' => $request->position_id,
            'cover_letter' => $request->cover_letter,
            'cv_path' => $cvPath,
            'portfolio_url' => $request->portfolio_url,
            'status' => 'pending'
        ]);

        return redirect()->route('applications.index')
            ->with('success', 'Je sollicitatie is succesvol ingediend.');
    }

    public function show($id)
    {
        $application = Application::with(['position.company'])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return Inertia::render('Applications/Show', [
            'application' => $application
        ]);
    }
} 