<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function stats()
    {
        return response()->json([
            'users' => User::count(),
            'companies' => Company::count(),
            'appointments' => Appointment::count(),
            'activeUsers' => User::where('is_active', true)->count(),
        ]);
    }

    public function users()
    {
        return response()->json(User::select('id', 'firstname', 'lastname', 'email', 'role')->get());
    }

    public function companies()
    {
        return response()->json(Company::select('id', 'name', 'email', 'is_active')->get());
    }

    public function appointments()
    {
        $appointments = Appointment::with(['timeSlot', 'timeSlot.company', 'student'])
            ->get()
            ->map(function($a) {
                return [
                    'id' => $a->id,
                    'student_name' => $a->student_firstname . ' ' . $a->student_lastname,
                    'company_name' => optional($a->timeSlot->company)->name,
                    'date' => optional($a->timeSlot)->start_time,
                ];
            });
        return response()->json($appointments);
    }
} 