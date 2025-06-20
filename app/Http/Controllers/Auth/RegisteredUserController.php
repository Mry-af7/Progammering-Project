<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('auth/Register');
    }

    public function createBedrijf(): Response
    {
        return Inertia::render('auth/Register-bedrijf');
    }

    public function store(Request $request): RedirectResponse
    {
        // Debug: Let's see what data is being sent
        \Log::info('Registration data:', $request->all());
        
        // Determine if this is a company registration
        $isCompany = $request->has('company_name') || $request->role === 'bedrijf';
        \Log::info('Is company registration:', ['isCompany' => $isCompany, 'has_company_name' => $request->has('company_name'), 'role' => $request->role]);
        
        // Handle name field based on what's available
        $name = '';
        if ($isCompany && $request->company_name) {
            $name = $request->company_name;
        } elseif ($request->firstname && $request->lastname) {
            $name = $request->firstname . ' ' . $request->lastname;
        } elseif ($request->name) {
            $name = $request->name;
        } else {
            // Fallback: use email prefix if no name fields found
            $name = explode('@', $request->email)[0];
        }

        \Log::info('Computed name:', ['name' => $name]);

        $request->merge(['name' => $name]);
        
        \Log::info('Request after merge:', $request->all());

        $validationRules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];

        // Add company-specific validation
        if ($isCompany) {
            $validationRules['company_name'] = 'required|string|max:255';
        }

        \Log::info('Validation rules:', $validationRules);
        
        try {
            $request->validate($validationRules);
            \Log::info('Validation passed');
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation failed:', ['errors' => $e->errors()]);
            throw $e;
        }

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $isCompany ? 'company' : 'student',
        ];
        
        \Log::info('User data to create:', $userData);

        $user = User::create($userData);
        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student',
        ]);

        event(new Registered($user));

        Auth::login($user);
        // Simple redirect - let's get this working first
        return redirect()->route('dashboard')->with('success', 'Registration successful!');
        return redirect(RouteServiceProvider::HOME);
    }

    public function storeBedrijf(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'industry' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
        ]);

        $user = User::create([
            'firstname' => $request->name,
            'lastname' => '',
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'company',
        ]);

        // Create company profile
        $user->company()->create([
            'name' => $request->name,
            'industry' => $request->industry,
            'description' => $request->description,
            'location' => $request->location,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}