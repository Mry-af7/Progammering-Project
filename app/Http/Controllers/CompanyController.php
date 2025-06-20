<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Company;
use App\Models\Student;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::with('favorites')
            ->paginate(10);
            
        return Inertia::render('Companies/Index', [
            'companies' => $companies,
        ]);
    }

    public function show(Company $company)
    {
        // Eager load relationships if needed
        $company->load('favorites', 'industry', 'companySize', 'technologies', 'benefits');
        
        return Inertia::render('Companies/Show', [
            'company' => $company
        ]);
    }

    public function dashboard()
    {
        $user = Auth::user();
        $company = Company::with(['industry', 'companySize', 'technologies', 'benefits', 'savedStudents.skills', 'savedStudents.languages', 'savedStudents.portfolios', 'savedStudents.hobbies'])
                         ->where('user_id', $user->id)
                         ->first();

        // Add students data for the search functionality
        $students = Student::with(['skills', 'languages', 'portfolios', 'hobbies'])
                          ->get();

        return Inertia::render('Company/Dashboard', [
            'user' => $user,
            'company' => $company,
            'students' => $students,
            'savedStudents' => $company?->savedStudents ?? [],
        ]);
    }

    /**
     * Save a student profile
     */
    public function saveStudent(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id'
        ]);

        $user = Auth::user();
        
        // Use the same pattern as in dashboard method
        $company = Company::where('user_id', $user->id)->first();
        
        if (!$company) {
            return back()->withErrors(['error' => 'No company found for this user']);
        }

        // Check if student is already saved
        if ($company->savedStudents()->where('student_id', $request->student_id)->exists()) {
            return back()->with('message', 'Student already saved');
        }

        // Save the student
        $company->savedStudents()->attach($request->student_id);
        
        return back()->with('success', 'Student saved successfully');
    }

    /**
     * Remove a saved student profile
     */
    public function unsaveStudent(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id'
        ]);

        $user = Auth::user();
        
        // Use the same pattern as in dashboard method
        $company = Company::where('user_id', $user->id)->first();
        
        if (!$company) {
            return back()->withErrors(['error' => 'No company found for this user']);
        }

        // Remove the student from saved list
        $company->savedStudents()->detach($request->student_id);
        
        return back()->with('success', 'Student removed from saved list');
    }
}