<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $students = User::role('student')->with(['profile'])->get();
        
        return Inertia::render('Students/Index', [
            'students' => $students
        ]);
    }

    public function show(User $student)
    {
        $student->load(['profile', 'appointments.company', 'favorites.company']);
        
        return Inertia::render('Students/Show', [
            'student' => $student
        ]);
    }

    public function edit(User $student)
    {
        $this->authorize('update', $student);
        
        return Inertia::render('Students/Edit', [
            'student' => $student->load('profile')
        ]);
    }

    public function update(Request $request, User $student)
    {
        $this->authorize('update', $student);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $student->id,
            'phone' => 'nullable|string|max:20',
            'education' => 'nullable|string|max:255',
            'graduation_year' => 'nullable|integer|min:2000|max:' . (date('Y') + 5),
            'bio' => 'nullable|string|max:1000',
        ]);

        $student->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        $student->profile()->updateOrCreate(
            ['user_id' => $student->id],
            [
                'phone' => $validated['phone'],
                'education' => $validated['education'],
                'graduation_year' => $validated['graduation_year'],
                'bio' => $validated['bio'],
            ]
        );

        return redirect()->route('students.show', $student)
            ->with('success', 'Profiel succesvol bijgewerkt.');
    }
} 