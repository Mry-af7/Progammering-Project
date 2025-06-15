<?php

namespace App\Http\Controllers;

use App\Models\TimeSlot;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class TimeSlotController extends Controller
{
    public function index(Request $request)
    {
        $query = TimeSlot::with('company');

        if ($request->has('company_id')) {
            $query->where('company_id', $request->company_id);
        }

        // Only show future time slots
        $query->where('start_time', '>', now());

        // Order by start time
        $query->orderBy('start_time');

        $timeSlots = $query->get();

        return response()->json(['time_slots' => $timeSlots]);
    }

    public function getCompanyTimeSlots(Company $company)
    {
        $timeSlots = TimeSlot::where('company_id', $company->id)
            ->where('start_time', '>', now())
            ->where('is_available', true)
            ->orderBy('start_time')
            ->get();

        return response()->json(['time_slots' => $timeSlots]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|exists:companies,id',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
            'duration' => 'required|integer|min:15|max:60' // Duration in minutes
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $startTime = Carbon::parse($request->start_time);
        $endTime = Carbon::parse($request->end_time);
        $duration = $request->duration;

        $timeSlots = [];

        while ($startTime->copy()->addMinutes($duration) <= $endTime) {
            $slotEndTime = $startTime->copy()->addMinutes($duration);

            $timeSlots[] = TimeSlot::create([
                'company_id' => $request->company_id,
                'start_time' => $startTime,
                'end_time' => $slotEndTime,
                'is_available' => true
            ]);

            $startTime->addMinutes($duration);
        }

        return response()->json([
            'message' => 'Tijdslots succesvol aangemaakt',
            'time_slots' => $timeSlots
        ]);
    }

    public function update(Request $request, TimeSlot $timeSlot)
    {
        $validator = Validator::make($request->all(), [
            'is_available' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $timeSlot->update([
            'is_available' => $request->is_available
        ]);

        return response()->json([
            'message' => 'Tijdslot succesvol bijgewerkt',
            'time_slot' => $timeSlot
        ]);
    }

    public function destroy(TimeSlot $timeSlot)
    {
        // Only allow deletion if no appointment is associated
        if ($timeSlot->appointment) {
            return response()->json([
                'error' => 'Kan tijdslot niet verwijderen omdat er een afspraak aan gekoppeld is'
            ], 422);
        }

        $timeSlot->delete();

        return response()->json(['message' => 'Tijdslot succesvol verwijderd']);
    }
}

 