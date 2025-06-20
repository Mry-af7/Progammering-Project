<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Education;
use App\Models\TechnicalSkill;
use App\Models\Language;
use App\Models\Hobby;
use App\Models\Project;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function showOnboarding()
    {
        // Check if user already completed profile
        if (auth()->user()->profile_completed) {
            return redirect()->route('dashboard');
        }

        return Inertia::render('Profile/Onboarding');
    }

    public function completeProfile(Request $request)
    {
        try {
            $user = auth()->user();
            
            // Log the incoming request data for debugging
            Log::info('Profile completion attempt for user: ' . $user->id, $request->all());
            
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'phone' => 'nullable|string|max:20',
                'location' => 'nullable|string|max:255',
                'major' => 'required|string|max:255',
                'specialization' => 'nullable|string|max:255',
                'github_username' => 'nullable|string|max:255',
                'projects_count' => 'nullable|integer|min:0',
                
                'education' => 'nullable|array',
                'education.*.degree' => 'required_with:education|string|max:255',
                'education.*.institution' => 'required_with:education|string|max:255',
                'education.*.year_range' => 'required_with:education|string|max:50',
                
                'technical_skills' => 'nullable|array',
                'technical_skills.*.name' => 'required_with:technical_skills|string|max:100',
                'technical_skills.*.is_primary' => 'boolean',
                
                'languages' => 'nullable|array',
                'languages.*.name' => 'required_with:languages|string|max:100',
                'languages.*.flag' => 'nullable|string|max:10',
                'languages.*.proficiency' => 'required_with:languages|string|max:50',
                
                'hobbies' => 'nullable|array',
                'hobbies.*.name' => 'required_with:hobbies|string|max:100',
                'hobbies.*.icon' => 'nullable|string|max:10',
                
                'portfolio' => 'nullable|array',
                'portfolio.*.name' => 'required_with:portfolio|string|max:255',
                'portfolio.*.technologies' => 'required_with:portfolio|string|max:500',
                'portfolio.*.description' => 'nullable|string|max:1000',
            ]);

            // Update user basic info
            $user->update([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'phone' => $validated['phone'] ?? null,
                'location' => $validated['location'] ?? null,
                'major' => $validated['major'],
                'specialization' => $validated['specialization'] ?? null,
                'github_username' => $validated['github_username'] ?? null,
                'projects_count' => $validated['projects_count'] ?? 0,
                'profile_completed' => true,
            ]);

            // Clear existing data to prevent duplicates
            $user->education()->delete();
            $user->technicalSkills()->delete();
            $user->languages()->delete();
            $user->hobbies()->delete();
            $user->projects()->delete();

            // Save education
            if (isset($validated['education']) && is_array($validated['education'])) {
                foreach ($validated['education'] as $education) {
                    Education::create([
                        'user_id' => $user->id,
                        'degree' => $education['degree'],
                        'institution' => $education['institution'],
                        'year_range' => $education['year_range'],
                    ]);
                }
            }

            // Save technical skills
            if (isset($validated['technical_skills']) && is_array($validated['technical_skills'])) {
                foreach ($validated['technical_skills'] as $skill) {
                    TechnicalSkill::create([
                        'user_id' => $user->id,
                        'name' => $skill['name'],
                        'is_primary' => $skill['is_primary'] ?? false,
                    ]);
                }
            }

            // Save languages
            if (isset($validated['languages']) && is_array($validated['languages'])) {
                foreach ($validated['languages'] as $language) {
                    Language::create([
                        'user_id' => $user->id,
                        'name' => $language['name'],
                        'flag' => $language['flag'] ?? null,
                        'proficiency' => $language['proficiency'],
                    ]);
                }
            }

            // Save hobbies
            if (isset($validated['hobbies']) && is_array($validated['hobbies'])) {
                foreach ($validated['hobbies'] as $hobby) {
                    Hobby::create([
                        'user_id' => $user->id,
                        'name' => $hobby['name'],
                        'icon' => $hobby['icon'] ?? null,
                    ]);
                }
            }

            // Save portfolio projects
            if (isset($validated['portfolio']) && is_array($validated['portfolio'])) {
                foreach ($validated['portfolio'] as $project) {
                    Project::create([
                        'user_id' => $user->id,
                        'name' => $project['name'],
                        'technologies' => $project['technologies'],
                        'description' => $project['description'] ?? null,
                    ]);
                }
            }

            Log::info('Profile completed successfully for user: ' . $user->id);
            
            return redirect()->route('dashboard')->with('message', 'Profile completed successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed for user: ' . auth()->id(), $e->errors());
            return back()->withErrors($e->errors())->withInput();
            
        } catch (\Exception $e) {
            Log::error('Profile completion failed for user: ' . auth()->id(), [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->with('error', 'Something went wrong. Please try again.')->withInput();
        }
    }
}