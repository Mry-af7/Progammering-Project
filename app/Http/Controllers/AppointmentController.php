<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Company;
use App\Models\Event;
use App\Models\TimeSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class AppointmentController extends Controller
{
    public function index()
    {
        // Get the next upcoming event
        $event = Event::query()
            ->where('date', '>=', now()->toDateString())
            ->where('is_active', true)
            ->first();

        // Get all companies, regardless of whether they have time slots
        $companies = Company::all();

        // Get time slots for the current event if it exists
        if ($event) {
            $timeSlots = TimeSlot::where('event_id', $event->id)
                ->where('start_time', '>', now())
                ->where('is_available', true)
                ->orderBy('start_time')
                ->get();

            // Group time slots by company
            $timeSlotsByCompany = $timeSlots->groupBy('company_id');
        } else {
            $timeSlotsByCompany = collect();
        }

        return Inertia::render('Afspraak', [
            'event' => $event ? [
                'id' => $event->id,
                'name' => $event->name,
                'description' => $event->description,
                'date' => $event->date,
                'start_time' => $event->start_time,
                'end_time' => $event->end_time,
                'location' => $event->location,
                'max_participants' => $event->max_participants,
                'is_active' => $event->is_active
            ] : null,
            'companies' => $companies->map(function($company) use ($timeSlotsByCompany) {
                return [
                    'id' => $company->id,
                    'name' => $company->name,
                    'description' => $company->description,
                    'logo_path' => $company->logo_path,
                    'website' => $company->website,
                    'email' => $company->email,
                    'phone' => $company->phone,
                    'address' => $company->address,
                    'city' => $company->city,
                    'postal_code' => $company->postal_code,
                    'timeSlots' => $timeSlotsByCompany->get($company->id, collect())->map(function($slot) {
                        return [
                            'id' => $slot->id,
                            'start_time' => $slot->start_time,
                            'end_time' => $slot->end_time,
                            'duration_minutes' => $slot->duration_minutes,
                            'is_available' => $slot->isAvailable()
                        ];
                    })
                ];
            }),
            'availableSpots' => $event ? TimeSlot::where('event_id', $event->id)
                                               ->where('is_available', true)
                                               ->where('start_time', '>', now())
                                               ->count() : 0,
            'totalSpots' => $event ? TimeSlot::where('event_id', $event->id)->count() : 0
        ]);
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
        if ($timeSlot->status !== 'available' || !$timeSlot->is_available) {
            return response()->json(['error' => 'Dit tijdslot is niet meer beschikbaar'], 422);
        }

        // Check if user already has an appointment for this event
        $existingAppointment = Appointment::where('student_id', Auth::id())
            ->whereHas('timeSlot', function ($query) use ($timeSlot) {
                $query->where('event_id', $timeSlot->event_id);
            })->exists();

        if ($existingAppointment) {
            return response()->json(['error' => 'Je hebt al een afspraak voor dit event'], 422);
        }

        // Create appointment
        $appointment = Appointment::create([
            'student_id' => Auth::id(),
            'company_id' => $request->company_id,
            'time_slot_id' => $request->time_slot_id,
            'status' => 'pending',
            'notes' => $request->motivatie,
            'student_name' => $request->voornaam . ' ' . $request->achternaam,
            'student_email' => $request->email,
            'student_phone' => $request->telefoon
        ]);

        // Update time slot
        $timeSlot->update([
            'status' => 'booked',
            'is_available' => false,
            'current_bookings' => $timeSlot->current_bookings + 1
        ]);

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

    public function getAvailableTimeSlots(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|exists:companies,id',
            'event_id' => 'required|exists:events,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $timeSlots = TimeSlot::where('company_id', $request->company_id)
            ->where('event_id', $request->event_id)
            ->where('status', 'available')
            ->where('is_available', true)
            ->where('start_time', '>', now())
            ->where('current_bookings', '<', DB::raw('max_students'))
            ->orderBy('start_time')
            ->get();

        return response()->json(['timeSlots' => $timeSlots]);
    }
} 