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
            'bedrijf_id' => 'required|exists:companies,id',
            'tijdslot_id' => 'required|exists:time_slots,id',
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
        $timeSlot = TimeSlot::findOrFail($request->tijdslot_id);
        if (!$timeSlot->is_available) {
            return response()->json(['error' => 'Dit tijdslot is niet meer beschikbaar'], 422);
        }

        // Create appointment
        $appointment = Appointment::create([
            'student_id' => Auth::id(),
            'company_id' => $request->bedrijf_id,
            'time_slot_id' => $request->tijdslot_id,
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
        $startDate = Carbon::now()->startOfDay();
        $endDate = Carbon::now()->addDays(14)->endOfDay();
        
        $bookedSlots = Appointment::where('company_id', $company->id)
            ->whereBetween('start_time', [$startDate, $endDate])
            ->get()
            ->map(function ($appointment) {
                return [
                    'start' => $appointment->start_time,
                    'end' => $appointment->end_time
                ];
            });

        $availableSlots = [];
        $currentDate = $startDate->copy();

        while ($currentDate <= $endDate) {
            if ($currentDate->isWeekday()) {
                for ($hour = 9; $hour < 17; $hour++) {
                    $slotStart = $currentDate->copy()->setHour($hour)->setMinute(0);
                    $slotEnd = $slotStart->copy()->addHour();

                    $isBooked = $bookedSlots->contains(function ($slot) use ($slotStart, $slotEnd) {
                        return $slotStart->between($slot['start'], $slot['end']) ||
                               $slotEnd->between($slot['start'], $slot['end']);
                    });

                    if (!$isBooked) {
                        $availableSlots[] = [
                            'start' => $slotStart->format('Y-m-d H:i:s'),
                            'end' => $slotEnd->format('Y-m-d H:i:s')
                        ];
                    }
                }
            }
            $currentDate->addDay();
        }

        return $availableSlots;
    }
} 