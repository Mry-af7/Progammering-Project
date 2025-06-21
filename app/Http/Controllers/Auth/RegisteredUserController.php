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
    /**
     * Display the student registration view.
     */
    public function create(): Response
    {
        return Inertia::render('auth/Register');
    }

    /**
     * Display the company registration view.
     */
    public function createBedrijf(): Response
    {
        return Inertia::render('auth/Register-bedrijf');
    }

    /**
     * Handle an incoming registration request for both students and companies.
     */
    public function store(Request $request): RedirectResponse
    {
        \Log::info('=== UNIFIED REGISTRATION ===');
        \Log::info('Registration data:', $request->all());
        
        // Determine if this is a company registration
        $isCompany = $request->user_type === 'company';
        \Log::info('Registration type:', ['isCompany' => $isCompany, 'user_type' => $request->user_type]);
        
        // Handle name field intelligently
        $name = $this->determineName($request, $isCompany);
        $request->merge(['name' => $name]);
        
        \Log::info('Final name determined:', ['name' => $name]);
        
        // Define validation rules
        $validationRules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];

        // Add student-specific validation for firstname/lastname approach
        if (!$isCompany && $request->has('firstname')) {
            $validationRules['firstname'] = 'required|string|max:255';
            $validationRules['lastname'] = 'required|string|max:255';
        }

        \Log::info('Validation rules:', $validationRules);
        
        // Validate the request
        try {
            $request->validate($validationRules);
            \Log::info('✅ Validation passed');
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('❌ Validation failed:', ['errors' => $e->errors()]);
            throw $e;
        }

        // Create user data
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $isCompany ? 'company' : 'student',
        ];

        \Log::info('Creating user with data:', $userData);

        // Create the user
        $user = User::create($userData);
        
        \Log::info('✅ User created successfully:', ['id' => $user->id, 'user_type' => $user->user_type]);

        // Fire the registered event
        event(new Registered($user));

        // Log the user in
        Auth::login($user);

        \Log::info('✅ User logged in, redirecting...');

        // Redirect based on user type
        if ($isCompany) {
            return redirect()->route('company.onboarding')
                ->with('success', 'Company registration successful! Please complete your company profile.');
        } else {
            return redirect()->route('profile-onboarding')
                ->with('success', 'Registration successful! Please complete your profile.');
        }
    }

    /**
     * Intelligently determine the name field based on available data.
     */
    private function determineName(Request $request, bool $isCompany): string
    {
        // For companies: use name field directly (this should be company name)
        if ($isCompany && $request->filled('name')) {
            return $request->name;
        }
        
        // For students: try firstname + lastname first
        if (!$isCompany && $request->filled('firstname') && $request->filled('lastname')) {
            return trim($request->firstname . ' ' . $request->lastname);
        }
        
        // Fallback: use name field if available
        if ($request->filled('name')) {
            return $request->name;
        }
        
        // Final fallback: use email prefix
        return explode('@', $request->email)[0];
    }

    /**
     * Legacy method for company registration (kept for backwards compatibility).
     * This should no longer be used since we unified the registration.
     */
    public function storeBedrijf(Request $request): RedirectResponse
    {
        \Log::warning('⚠️ Legacy storeBedrijf method called - should use unified store() method instead');
        
        // Redirect to the unified registration
        $request->merge(['user_type' => 'company']);
        return $this->store($request);
    }
}