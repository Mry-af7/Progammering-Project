<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Student;
use App\Models\Favorite;

class DashboardController extends Controller
{
    /**
     * Display the user's dashboard.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function __invoke(Request $request)
    {
        $user = $request->user();

        if (!$user->profile_completed) {
            return $user->role === 'company'
                ? to_route('company.onboarding.show', ['step' => 1])
                : to_route('profile-onboarding');
        }

        $student = null;
        $studentData = null;
        if ($user->role === 'student') {
            $student = Student::where('user_id', $user->id)
                ->with(['skills', 'studyField'])
                ->first();

            if ($student) {
                $studentData = [
                    'major' => $student->studyField->name ?? 'Niet opgegeven',
                    'year_of_study' => $student->year_of_study ?? 'Niet opgegeven',
                    'skills' => $student->skills->pluck('name') ?? [],
                    // Add other student-specific data points here
                ];
            }
        }
        
        // Combine user and student data for the view
        $viewUser = array_merge($user->toArray(), [
            'major' => $studentData['major'] ?? 'Computer Science',
            'year' => $studentData['year_of_study'] ?? '3de Jaar',
            'studentId' => $student?->student_id,
        ]);

        $favorites = Favorite::where('user_id', $user->id)
            ->with('favoritable')
            ->latest()
            ->limit(5)
            ->get();
            
        // Mock data for the new dashboard design
        $stats = [
            'semester' => $studentData['year_of_study'] ?? '3de Jaar',
            'completed_projects' => 12,
            'skills_mastered' => count($studentData['skills'] ?? []),
            'applications' => 5,
        ];

        $applications = [
            ['id' => 1, 'company' => 'Accenture', 'position' => 'Junior Developer', 'status' => 'interview', 'type' => 'Stage', 'location' => 'Brussels', 'salary' => '€1200', 'applied_at' => '2025-06-15'],
            ['id' => 2, 'company' => 'Amista', 'position' => 'Frontend Developer', 'status' => 'pending', 'type' => 'Stage', 'location' => 'Lier', 'salary' => '€1000', 'applied_at' => '2025-06-10'],
            ['id' => 3, 'company' => 'Acolad', 'position' => 'Full Stack Developer', 'status' => 'accepted', 'type' => 'Job', 'location' => 'Brussels', 'salary' => '€2500', 'applied_at' => '2025-06-05'],
        ];

        $upcomingMeetings = [
            ['id' => 1, 'title' => 'Career Gesprek - Accenture', 'company' => 'Accenture', 'datetime' => '2025-06-22T14:00:00', 'type' => 'interview', 'location' => 'Online - Teams', 'recruiter' => 'Sarah Van Der Berg'],
            ['id' => 2, 'title' => 'Stage Oriëntatie', 'company' => 'Erasmus Hogeschool', 'datetime' => '2025-06-25T10:00:00', 'type' => 'orientation', 'location' => 'Campus Kaai - A101', 'recruiter' => 'Prof. Dr. Smith'],
        ];

        return Inertia::render('Dashboard', [
            'user' => $viewUser,
            'student' => $studentData, // Legacy, can be removed if frontend is fully refactored
            'favorites' => $favorites,
            'stats' => $stats,
            'applications' => $applications,
            'upcomingMeetings' => $upcomingMeetings,
            // Add other mock data as needed
        ]);
    }
}