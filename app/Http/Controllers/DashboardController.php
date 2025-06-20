<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Student;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Check if profile is completed and redirect to appropriate onboarding
        if (!$user->profile_completed) {
            if ($user->isCompany()) {
                return redirect()->route('company.onboarding.show', ['step' => 1]);
            } else {
                return redirect()->route('profile-onboarding');
            }
        }

        // Get student data if user is a student
        $studentData = null;
        if ($user->isStudent()) {
            $student = Student::where('email', $user->email)
                ->with(['skills', 'languages', 'hobbies', 'portfolios'])
                ->first();
            
            // Debug: Log what we found
            \Log::info('Student found:', ['student' => $student ? $student->toArray() : 'null']);
            
            if ($student) {
                $studentData = [
                    'name' => $student->name,
                    'email' => $student->email,
                    'major' => $student->major,
                    'github_link' => $student->github_link,
                    'skills' => $student->skills->map(function ($skill) {
                        return [
                            'name' => $skill->name,
                            'proficiency' => $skill->pivot->proficiency_level
                        ];
                    }),
                    'languages' => $student->languages->map(function ($language) {
                        return [
                            'name' => $language->name,
                            'fluency' => $language->pivot->fluency_level
                        ];
                    }),
                    'hobbies' => $student->hobbies->map(function ($hobby) {
                        return ['name' => $hobby->name];
                    }),
                    'portfolios' => $student->portfolios->map(function ($portfolio) {
                        return [
                            'name' => $portfolio->name,
                            'url' => $portfolio->url
                        ];
                    })
                ];
                
                // Debug: Log the formatted student data
                \Log::info('Formatted student data:', $studentData);
            }
        }

        return Inertia::render('Dashboard', [
            'user' => $user,
            'student' => $studentData,
            'message' => 'Welcome to your dashboard!'
        ]);
    }
}