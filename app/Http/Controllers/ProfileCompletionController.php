<?php
// app/Http/Controllers/ProfileCompletionController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileCompletionController extends Controller
{
    public function show()
    {
        $student = auth()->user();
        
        if (!$student->onboarding_started_at) {
            $student->onboarding_started_at = now();
            $student->save();
        }

        $incompleteSections = $student->getIncompleteSections();
        $currentPercentage = $student->calculateCompletionPercentage();

        return Inertia::render('Profile/Complete', [
            'student' => $student,
            'incompleteSections' => $incompleteSections,
            'completionPercentage' => $currentPercentage,
            'academicPrograms' => $this->getAcademicPrograms(),
            'academicYears' => ['1st Year', '2nd Year', '3rd Year', '4th Year', 'Graduate']
        ]);
    }

    public function updatePersonalInfo(Request $request)
    {
        $student = auth()->user();

        $request->validate([
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'required|date|before:today',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->only(['phone', 'date_of_birth']);

        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($student->profile_photo) {
                Storage::disk('public')->delete($student->profile_photo);
            }

            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $data['profile_photo'] = $path;
        }

        $student->update($data);
        $newPercentage = $student->calculateCompletionPercentage();

        return response()->json([
            'success' => true,
            'completion_percentage' => $newPercentage,
            'message' => 'Personal information updated successfully!'
        ]);
    }

    public function updateEmergencyContact(Request $request)
    {
        $student = auth()->user();

        $request->validate([
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:20'
        ]);

        $student->update($request->only(['emergency_contact_name', 'emergency_contact_phone']));
        $newPercentage = $student->calculateCompletionPercentage();

        return response()->json([
            'success' => true,
            'completion_percentage' => $newPercentage,
            'message' => 'Emergency contact updated successfully!'
        ]);
    }

    public function updateAcademicInfo(Request $request)
    {
        $student = auth()->user();

        $request->validate([
            'student_id_number' => [
                'required',
                'string',
                'max:20',
                Rule::unique('students', 'student_id_number')->ignore($student->id)
            ],
            'academic_program' => 'required|string|max:255',
            'academic_year' => 'required|string|max:50'
        ]);

        $student->update($request->only(['student_id_number', 'academic_program', 'academic_year']));
        $newPercentage = $student->calculateCompletionPercentage();

        return response()->json([
            'success' => true,
            'completion_percentage' => $newPercentage,
            'message' => 'Academic information updated successfully!'
        ]);
    }

    public function updatePreferences(Request $request)
    {
        $student = auth()->user();

        $request->validate([
            'communication_preferences' => 'required|array',
            'communication_preferences.*' => 'string|in:email,sms,push_notifications,phone'
        ]);

        $student->update([
            'communication_preferences' => $request->communication_preferences
        ]);

        $newPercentage = $student->calculateCompletionPercentage();

        return response()->json([
            'success' => true,
            'completion_percentage' => $newPercentage,
            'message' => 'Preferences updated successfully!'
        ]);
    }

    public function updateAdditionalInfo(Request $request)
    {
        $student = auth()->user();

        $request->validate([
            'bio' => 'nullable|string|max:500',
            'interests' => 'nullable|array',
            'interests.*' => 'string|max:50'
        ]);

        $student->update($request->only(['bio', 'interests']));
        $newPercentage = $student->calculateCompletionPercentage();

        return response()->json([
            'success' => true,
            'completion_percentage' => $newPercentage,
            'message' => 'Additional information updated successfully!'
        ]);
    }

    public function completeOnboarding(Request $request)
    {
        $student = auth()->user();

        if ($student->completion_percentage >= 70) {
            $student->update([
                'onboarding_completed' => true,
                'profile_completed_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Profile completed successfully!',
                'redirect' => route('dashboard')
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Please complete at least 70% of your profile before finishing.'
        ], 422);
    }

    private function getAcademicPrograms()
    {
        return [
            'Computer Science',
            'Information Technology',
            'Business Administration',
            'Engineering',
            'Medicine',
            'Nursing',
            'Education',
            'Arts and Sciences',
            'Other'
        ];
    }
}