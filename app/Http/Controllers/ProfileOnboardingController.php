<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Student;
use App\Models\Skill;
use App\Models\Language;
use App\Models\Hobby;
use App\Models\StudentPortfolio;
use Illuminate\Support\Facades\Auth;

class ProfileOnboardingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $student = Student::where('email', $user->email)->first();
        
        if (!$student) {
            $student = Student::create([
                'user_id' => $user->id,
                'study_field_id' => 1,
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
                'email' => $user->email,
                'major' => '',
                'github_link' => '',
                'year_of_study' => '',
                'about_me' => '',
                'linkedin_url' => '',
                'custom_link_title' => '',
                'custom_link_url' => ''
            ]);
        }

        return Inertia::render('ProfileOnboarding/Index', [
            'student' => $student,
            'currentStep' => 1
        ]);
    }

    public function showStep($step)
    {
        $user = Auth::user();
        $student = Student::where('email', $user->email)->first();

        $data = [
            'student' => $student,
            'currentStep' => (int)$step
        ];

        switch ($step) {
            case '2':
                return Inertia::render('ProfileOnboarding/GitHubPortfolio', $data);
            case '3':
                $data['skills'] = Skill::all();
                $data['studentSkills'] = $student->skills()->get();
                return Inertia::render('ProfileOnboarding/Skills', $data);
            case '4':
                $data['languages'] = Language::all();
                $data['studentLanguages'] = $student->languages()->get();
                return Inertia::render('ProfileOnboarding/Languages', $data);
            case '5':
                $data['studentHobbies'] = $student->hobbies()->get();
                return Inertia::render('ProfileOnboarding/Hobbies', $data);
            case '6':
                $data['student'] = $student->load(['skills', 'languages', 'hobbies', 'portfolios']);
                return Inertia::render('ProfileOnboarding/Review', $data);
            default:
                return Inertia::render('ProfileOnboarding/Index', $data);
        }
    }

    public function storeBasicInfo(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'major' => 'required|string|max:255',
            'year_of_study' => 'required|string|max:255',
            'about_me' => 'nullable|string|max:1000',
            'linkedin_url' => 'nullable|url|max:255',
            'custom_link_title' => 'nullable|string|max:255',
            'custom_link_url' => 'nullable|url|max:255',
        ]);

        $user = Auth::user();
        $student = Student::where('email', $user->email)->first();

        $student->update([
            'name' => $request->name,
            'major' => $request->major,
            'year_of_study' => $request->year_of_study,
            'about_me' => $request->about_me,
            'linkedin_url' => $request->linkedin_url,
            'custom_link_title' => $request->custom_link_title,
            'custom_link_url' => $request->custom_link_url,
        ]);

        return redirect()->route('profile-onboarding.step', 2);
    }

    public function storeGitHubPortfolio(Request $request)
    {
        $request->validate([
            'github_link' => 'nullable|url',
            'portfolios' => 'nullable|array',
            'portfolios.*.name' => 'required|string|max:255',
            'portfolios.*.url' => 'required|url'
        ]);

        $user = Auth::user();
        $student = Student::where('email', $user->email)->first();

        $student->update([
            'github_link' => $request->github_link
        ]);

        // Delete existing portfolios and add new ones
        $student->portfolios()->delete();
        if ($request->portfolios) {
            foreach ($request->portfolios as $portfolio) {
                StudentPortfolio::create([
                    'student_id' => $student->id,
                    'name' => $portfolio['name'],
                    'url' => $portfolio['url']
                ]);
            }
        }

        return redirect()->route('profile-onboarding.step', 3);
    }

    public function storeSkills(Request $request)
    {
        $request->validate([
            'skills' => 'required|array|min:1',
            'skills.*.skill_id' => 'required|exists:skills,id',
            'skills.*.proficiency_level' => 'required|in:Beginner,Intermediate,Advanced,Expert'
        ]);

        $user = Auth::user();
        $student = Student::where('email', $user->email)->first();

        // Sync skills with proficiency levels
        $skillsData = [];
        foreach ($request->skills as $skill) {
            $skillsData[$skill['skill_id']] = ['proficiency_level' => $skill['proficiency_level']];
        }
        
        $student->skills()->sync($skillsData);

        return redirect()->route('profile-onboarding.step', 4);
    }

    public function storeLanguages(Request $request)
    {
        $request->validate([
            'languages' => 'required|array|min:1',
            'languages.*.language_id' => 'required|exists:languages,id',
            'languages.*.fluency_level' => 'required|in:Basic,Conversational,Business,Fluent,Native'
        ]);

        $user = Auth::user();
        $student = Student::where('email', $user->email)->first();

        // Sync languages with fluency levels
        $languagesData = [];
        foreach ($request->languages as $language) {
            $languagesData[$language['language_id']] = ['fluency_level' => $language['fluency_level']];
        }
        
        $student->languages()->sync($languagesData);

        return redirect()->route('profile-onboarding.step', 5);
    }

    public function storeHobbies(Request $request)
    {
        $request->validate([
            'hobbies' => 'required|array|size:3',
            'hobbies.*' => 'required|string|max:255'
        ]);

        $user = Auth::user();
        $student = Student::where('email', $user->email)->first();

        // Clear existing hobbies
        $student->hobbies()->detach();

        // Add new hobbies
        foreach ($request->hobbies as $hobbyName) {
            $hobby = Hobby::create(['name' => $hobbyName]);
            $student->hobbies()->attach($hobby->id);
        }

        return redirect()->route('profile-onboarding.step', 6);
    }

    public function complete()
    {
        $user = Auth::user();
        
        // Mark profile as completed
        $user->update(['profile_completed' => true]);
        
        return redirect()->route('dashboard')->with('success', 'Profile completed successfully!');
    }
}