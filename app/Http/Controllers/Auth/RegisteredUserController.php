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
        // Determine if this is a company registration
        $isCompany = $request->filled('company_name') || $request->user_type === 'company' || $request->role === 'bedrijf';
       
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
 
        $request->merge(['name' => $name]);
 
        $validationRules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
 
        // Add company-specific validation
        if ($isCompany) {
            $validationRules['company_name'] = 'required|string|max:255';
        } else {
            // Add student-specific validation
            $validationRules['firstname'] = 'required|string|max:255';
            $validationRules['lastname'] = 'required|string|max:255';
        }
       
        $request->validate($validationRules);
 
        $userData = [
            'firstname' => $isCompany ? null : $request->firstname,
            'lastname' => $isCompany ? null : $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $isCompany ? 'company' : 'student',
            'role' => $isCompany ? 'company' : 'student',
            'is_active' => true,
            'profile_completed' => false,
        ];
 
        $user = User::create($userData);
 
        event(new Registered($user));
 
        Auth::login($user);
 
        // Redirect based on user type
        if ($isCompany) {
            return redirect()->route('company.onboarding')->with('success', 'Company registration successful! Please complete your company profile.');
        } else {
            return redirect()->route('profile-onboarding')->with('success', 'Registration successful! Please complete your profile.');
        }
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
            'firstname' => null,
            'lastname' => null,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => 'company',
            'role' => 'company',
            'is_active' => true,
            'profile_completed' => false,
        ]);
 
        // Create company profile
        $user->company()->create([
            'name' => $request->name,
            'industry_id' => null, // Will be set during onboarding
            'description' => $request->description,
            'headquarters' => $request->location,
            'onboarding_completed' => false,
        ]);
 
        event(new Registered($user));
 
        Auth::login($user);
 
        return redirect()->route('company.onboarding')->with('success', 'Company registration successful! Please complete your company profile.');
    }
}
 