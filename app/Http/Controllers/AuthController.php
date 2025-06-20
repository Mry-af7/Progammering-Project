<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return Inertia::render('auth/Login', [
            'canResetPassword' => true,
            'status' => session('status'),
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();
            
            // Redirect naar juiste dashboard op basis van rol
            switch ($user->role) {
                case 'admin':
                    return redirect()->intended('/admin/dashboard');
                case 'bedrijf':
                    return redirect()->intended('/bedrijf/dashboard');
                case 'student':
                default:
                    return redirect()->intended('/student/dashboard');
            }
        }

        throw ValidationException::withMessages([
            'email' => 'Deze inloggegevens komen niet overeen met onze gegevens.',
        ]);
    }

    public function showRegisterForm(Request $request)
    {
        $type = $request->query('type', 'student');
        
        return Inertia::render('auth/Register', [
            'type' => $type
        ]);
    }

    public function register(Request $request)
    {
        $rules = [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:student,bedrijf',
            'age' => 'required|integer|min:16|max:100',
            'gender' => 'required|in:man,vrouw,anders',
        ];

        // Voeg specifieke validaties toe op basis van rol
        if ($request->role === 'student') {
            $rules['field_of_study'] = 'required|string|max:255';
            $rules['cv'] = 'nullable|file|mimes:pdf,doc,docx|max:5120'; // 5MB max
        } elseif ($request->role === 'bedrijf') {
            $rules['company_name'] = 'required|string|max:255';
        }

        $validated = $request->validate($rules);

        // Handle CV upload
        $cvPath = null;
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs', 'private');
        }

        $user = User::create([
            'name' => $validated['firstname'] . ' ' . $validated['lastname'],
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'age' => $validated['age'],
            'gender' => $validated['gender'],
            'field_of_study' => $validated['field_of_study'] ?? null,
            'company_name' => $validated['company_name'] ?? null,
            'cv_path' => $cvPath,
            'is_active' => true,
        ]);

        Auth::login($user);

        // Redirect naar juiste dashboard
        switch ($user->role) {
            case 'bedrijf':
                return redirect('/bedrijf/dashboard');
            case 'student':
            default:
                return redirect('/student/dashboard');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
} 