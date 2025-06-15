<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Company;
use App\Models\TimeSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['company', 'timeSlot'])
            ->where('student_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['appointments' => $appointments]);
    }

    public function create(Company $company)
    {
        return Inertia::render('Appointments/Create', [
            'company' => $company,
            'availableSlots' => $this->getAvailableTimeSlots($company)
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|exists:companies,id',
            'time_slot_id' => 'required|exists:time_slots,id',
            'voornaam' => 'required|string|max:255',
            'achternaam' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefoon' => 'required|string|max:20',
            'motivatie' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Check if time slot is still available
        $timeSlot = TimeSlot::findOrFail($request->time_slot_id);
        if (!$timeSlot->is_available) {
            return response()->json(['error' => 'Dit tijdslot is niet meer beschikbaar'], 422);
        }

        // Create appointment
        $appointment = Appointment::create([
            'student_id' => Auth::id(),
            'company_id' => $request->company_id,
            'time_slot_id' => $request->time_slot_id,
            'status' => 'pending',
            'notes' => $request->motivatie
        ]);

        // Mark time slot as unavailable
        $timeSlot->update(['is_available' => false]);

        return response()->json([
            'message' => 'Afspraak succesvol ingepland',
            'appointment' => $appointment->load(['company', 'timeSlot'])
        ]);
    }

    public function show(Appointment $appointment)
    {
        $this->authorize('view', $appointment);
        return response()->json(['appointment' => $appointment->load(['company', 'timeSlot'])]);
    }

    public function update(Request $request, Appointment $appointment)
    {
        $this->authorize('update', $appointment);

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,confirmed,cancelled'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $appointment->update([
            'status' => $request->status
        ]);

        return response()->json([
            'message' => 'Afspraak succesvol bijgewerkt',
            'appointment' => $appointment->load(['company', 'timeSlot'])
        ]);
    }

    public function destroy(Appointment $appointment)
    {
        $this->authorize('delete', $appointment);

        // Mark time slot as available again
        $appointment->timeSlot->update(['is_available' => true]);

        $appointment->delete();

        return response()->json(['message' => 'Afspraak succesvol geannuleerd']);
    }

    public function getAvailableTimeSlots(Company $company)
    {
        return TimeSlot::where('company_id', $company->id)
            ->where('is_available', true)
            ->whereBetween('start_time', [Carbon::now()->startOfDay(), Carbon::now()->addDays(14)->endOfDay()])
            ->orderBy('start_time')
            ->get();
    }
} 