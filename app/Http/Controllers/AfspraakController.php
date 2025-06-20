<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Models\Appointment;
use App\Models\Company;
use App\Models\Event;
use App\Models\TimeSlot;
use App\Models\User;
use Carbon\Carbon;
use Inertia\Inertia;
use App\Mail\AppointmentConfirmation;

class AfspraakController extends Controller
{
    /**
     * Show the appointment creation page
     */
    public function index()
    {
        $userAppointments = [];
        
        // Get user's existing appointments if logged in
        if (Auth::check()) {
            $userAppointments = $this->getUserAppointments();
        }

        return Inertia::render('Afspraak', [
            'bedrijven' => $this->getBedrijven(),
            'beschikbareTijdslots' => $this->getBeschikbareTijdslots(),
            'studierichtingen' => $this->getStudierichtingen(),
            'eventInfo' => $this->getCurrentEvent(),
            'userAppointments' => $userAppointments,
            'allCompanies' => \App\Models\Company::select(['id', 'name', 'description', 'logo'])->get(),
            'allTimeSlots' => \App\Models\TimeSlot::where('is_available', true)->get(),
        ]);
    }

    /**
     * Get companies data in the format expected by Vue
     */
    public function getBedrijven()
    {
        // Try to get from database first, fallback to static data
        try {
            $companies = DB::table('companies')
                ->where('is_active', true)
                ->where('participating_in_career_launch', true)
                ->select(['id', 'name as naam', 'description as beschrijving', 'tags'])
                ->get()
                ->map(function ($company) {
                    return [
                        'id' => $company->id,
                        'naam' => $company->naam,
                        'beschrijving' => $company->beschrijving,
                        'tags' => json_decode($company->tags, true) ?? []
                    ];
                })
                ->toArray();

            if (count($companies) > 0) {
                return response()->json($companies);
            }
        } catch (\Exception $e) {
            Log::warning('Could not fetch companies from database, using static data: ' . $e->getMessage());
        }

        // Fallback to static data
        $staticCompanies = [
            [
                'id' => 'microsoft',
                'naam' => 'Microsoft Belgium',
                'beschrijving' => 'Tech giant met focus op cloud computing, AI en enterprise solutions.',
                'tags' => ['Cloud', 'AI', 'Enterprise']
            ],
            [
                'id' => 'accenture',
                'naam' => 'Accenture',
                'beschrijving' => 'Global consultancy diensten in technologie en digitale transformatie.',
                'tags' => ['Consulting', 'Digital', 'Innovation']
            ],
            [
                'id' => 'deloitte',
                'naam' => 'Deloitte Digital',
                'beschrijving' => 'Digitale innovatie en consultancy voor enterprise klanten.',
                'tags' => ['Digital', 'Strategy', 'Tech']
            ],
            [
                'id' => 'proximus',
                'naam' => 'Proximus',
                'beschrijving' => 'Telecom leader met focus op 5G, IoT en digitale services.',
                'tags' => ['Telecom', '5G', 'IoT']
            ],
            [
                'id' => 'colruyt',
                'naam' => 'Colruyt Group IT',
                'beschrijving' => 'Retail technologie en e-commerce innovaties.',
                'tags' => ['Retail', 'E-commerce', 'Innovation']
            ],
            [
                'id' => 'kbc',
                'naam' => 'KBC Group',
                'beschrijving' => 'Financial services en FinTech innovaties.',
                'tags' => ['FinTech', 'Banking', 'Innovation']
            ],
            [
                'id' => 'telenet',
                'naam' => 'Telenet',
                'beschrijving' => 'Digital entertainment en telecommunicatie services.',
                'tags' => ['Telecom', 'Media', 'Digital']
            ]
        ];

        return response()->json($staticCompanies);
    }

    /**
     * Get available time slots in the format expected by Vue
     */
    public function getBeschikbareTijdslots()
    {
        $eventDate = '2025-03-25';
        
        // Get existing appointments for the event date
        $existingAppointments = DB::table('appointments')
            ->whereDate('appointment_date', $eventDate)
            ->where('status', '!=', 'cancelled')
            ->pluck('time_slot_id')
            ->toArray();

        // Count appointments per time slot
        $appointmentCounts = DB::table('appointments')
            ->whereDate('appointment_date', $eventDate)
            ->where('status', '!=', 'cancelled')
            ->select('time_slot_id', DB::raw('count(*) as count'))
            ->groupBy('time_slot_id')
            ->pluck('count', 'time_slot_id')
            ->toArray();

        $maxParticipantsPerSlot = 20; // Can be configured

        $timeSlots = [
            ['id' => '1', 'tijd' => '09:00 - 09:15', 'info' => '25 maart 2025'],
            ['id' => '2', 'tijd' => '09:20 - 09:35', 'info' => '25 maart 2025'],
            ['id' => '3', 'tijd' => '09:40 - 09:55', 'info' => '25 maart 2025'],
            ['id' => '4', 'tijd' => '10:00 - 10:15', 'info' => '25 maart 2025'],
            ['id' => '5', 'tijd' => '10:20 - 10:35', 'info' => '25 maart 2025'],
            ['id' => '6', 'tijd' => '10:40 - 10:55', 'info' => '25 maart 2025'],
            ['id' => '7', 'tijd' => '11:00 - 11:15', 'info' => '25 maart 2025'],
            ['id' => '8', 'tijd' => '11:20 - 11:35', 'info' => '25 maart 2025'],
            ['id' => '9', 'tijd' => '13:00 - 13:15', 'info' => '25 maart 2025'],
            ['id' => '10', 'tijd' => '13:20 - 13:35', 'info' => '25 maart 2025'],
            ['id' => '11', 'tijd' => '13:40 - 13:55', 'info' => '25 maart 2025'],
            ['id' => '12', 'tijd' => '14:00 - 14:15', 'info' => '25 maart 2025'],
            ['id' => '13', 'tijd' => '14:20 - 14:35', 'info' => '25 maart 2025'],
            ['id' => '14', 'tijd' => '14:40 - 14:55', 'info' => '25 maart 2025'],
            ['id' => '15', 'tijd' => '15:00 - 15:15', 'info' => '25 maart 2025'],
            ['id' => '16', 'tijd' => '15:20 - 15:35', 'info' => '25 maart 2025']
        ];

        $formattedSlots = array_map(function ($slot) use ($appointmentCounts, $maxParticipantsPerSlot) {
            $currentCount = $appointmentCounts[$slot['id']] ?? 0;
            $slot['beschikbaar'] = $currentCount < $maxParticipantsPerSlot;
            $slot['remaining_spots'] = max(0, $maxParticipantsPerSlot - $currentCount);
            return $slot;
        }, $timeSlots);

        return response()->json(['tijdslots' => $formattedSlots]);
    }

    /**
     * Get study programs
     */
    private function getStudierichtingen()
    {
        return [
            'Multimedia & Creatieve Technologie',
            'Toegepaste Informatica',
            'Internet of Things',
            'Industrieel Ingenieur',
            'Grafische en Digitale Media',
            'Business Management',
            'Communicatiemanagement',
            'International Business',
            'Anders'
        ];
    }

    /**
     * Get current event info
     */
    private function getCurrentEvent()
    {
        return [
            'name' => 'Career Launch 2025',
            'date' => '25 maart 2025',
            'location' => 'Erasmushogeschool Brussel - Campus Kaai',
            'duration' => '15 minuten per gesprek',
            'max_participants' => '20 per tijdslot',
            'description' => 'Een unieke kans om rechtstreeks in contact te komen met topbedrijven uit verschillende sectoren.',
            'start_time' => '09:00',
            'end_time' => '16:00'
        ];
    }

    /**
     * Get user's existing appointments
     */
    private function getUserAppointments()
    {
        if (!Auth::check()) {
            return [];
        }

        $appointments = DB::table('appointments')
            ->where('student_id', Auth::id())
            ->whereDate('appointment_date', '>=', now()->toDateString())
            ->orderBy('appointment_date')
            ->orderBy('time_slot_id')
            ->get();

        $bedrijven = collect($this->getBedrijven())->keyBy('id');
        $tijdslots = collect($this->getBeschikbareTijdslots())->keyBy('id');

        return $appointments->map(function ($appointment) use ($bedrijven, $tijdslots) {
            $company = $bedrijven->get($appointment->company_id);
            $timeSlot = $tijdslots->get($appointment->time_slot_id);

            return [
                'id' => $appointment->id,
                'company_name' => $company['naam'] ?? 'Onbekend bedrijf',
                'company_id' => $appointment->company_id,
                'time_slot' => $timeSlot['tijd'] ?? 'Onbekend tijdslot',
                'time_slot_id' => $appointment->time_slot_id,
                'date' => Carbon::parse($appointment->appointment_date)->format('d M Y'),
                'status' => $appointment->status,
                'student_notes' => $appointment->student_notes,
                'company_notes' => $appointment->company_notes ?? null,
                'created_at' => Carbon::parse($appointment->created_at)->format('d M Y H:i')
            ];
        })->toArray();
    }

    /**
     * Store a new appointment (handle form submission)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'time_slot_id' => 'required|exists:time_slots,id',
            'student_firstname' => 'required|string|max:255',
            'student_lastname' => 'required|string|max:255',
            'student_email' => 'required|email|max:255',
            'student_phone' => 'required|string|max:20|regex:/^[0-9+\s-()]{10,}$/',
            'study_field' => 'required|string|max:255',
            'study_year' => 'required|integer|between:1,5',
            'student_notes' => 'nullable|string|max:1000',
        ]);

        try {
            DB::beginTransaction();

            // Check if time slot is still available
            $timeSlot = TimeSlot::findOrFail($validated['time_slot_id']);
            if (!$timeSlot->isAvailable()) {
                throw new \Exception('Deze tijdslot is niet meer beschikbaar.');
            }

            // Create appointment
            $appointment = Appointment::create([
                'time_slot_id' => $validated['time_slot_id'],
                'student_firstname' => $validated['student_firstname'],
                'student_lastname' => $validated['student_lastname'],
                'student_email' => $validated['student_email'],
                'student_phone' => $validated['student_phone'],
                'study_field' => $validated['study_field'],
                'study_year' => $validated['study_year'],
                'student_notes' => $validated['student_notes'],
                'status' => 'pending',
            ]);

            // Update time slot availability
            $timeSlot->update(['status' => 'booked']);

            // Send confirmation email
            Mail::to($validated['student_email'])->send(new AppointmentConfirmation($appointment));

            DB::commit();

            return redirect()->route('appointments.show', $appointment)
                ->with('success', 'Je afspraak is succesvol ingepland!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Er is een fout opgetreden bij het inplannen van je afspraak. Probeer het later opnieuw.']);
        }
    }

    /**
     * Get user's appointments (API endpoint)
     */
    public function getUserAppointmentsApi()
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'appointments' => $this->getUserAppointments()
        ]);
    }

    /**
     * Cancel an appointment
     */
    public function cancel($id)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $appointment = DB::table('appointments')
            ->where('id', $id)
            ->where('student_id', Auth::id())
            ->first();

        if (!$appointment) {
            return response()->json(['error' => 'Afspraak niet gevonden'], 404);
        }

        if ($appointment->status === 'cancelled') {
            return response()->json(['error' => 'Afspraak is al geannuleerd'], 422);
        }

        // Check if appointment is not too close (e.g., within 24 hours)
        $appointmentDateTime = Carbon::parse($appointment->appointment_date . ' 09:00:00');
        if ($appointmentDateTime->diffInHours(now()) < 24) {
            return response()->json([
                'error' => 'Afspraken kunnen niet binnen 24 uur voor de geplande tijd geannuleerd worden.'
            ], 422);
        }

        try {
            DB::table('appointments')
                ->where('id', $id)
                ->update([
                    'status' => 'cancelled',
                    'cancelled_at' => now(),
                    'updated_at' => now()
                ]);

            Log::info('Appointment cancelled', [
                'appointment_id' => $id,
                'student_id' => Auth::id()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Afspraak succesvol geannuleerd'
            ]);

        } catch (\Exception $e) {
            Log::error('Error cancelling appointment: ' . $e->getMessage(), [
                'appointment_id' => $id,
                'student_id' => Auth::id()
            ]);
            
            return response()->json([
                'error' => 'Er is een fout opgetreden bij het annuleren'
            ], 500);
        }
    }

    /**
     * Get updated time slots (for real-time availability)
     */
    public function getTimeSlots()
    {
        return response()->json([
            'tijdslots' => $this->getBeschikbareTijdslots(),
            'last_updated' => now()->toISOString()
        ]);
    }

    /**
     * Get appointment statistics
     */
    public function getStats()
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $stats = [
            'total_appointments' => DB::table('appointments')
                ->where('student_id', Auth::id())
                ->count(),
            'confirmed_appointments' => DB::table('appointments')
                ->where('student_id', Auth::id())
                ->where('status', 'confirmed')
                ->count(),
            'upcoming_appointments' => DB::table('appointments')
                ->where('student_id', Auth::id())
                ->where('status', 'confirmed')
                ->whereDate('appointment_date', '>=', now()->toDateString())
                ->count(),
            'companies_met' => DB::table('appointments')
                ->where('student_id', Auth::id())
                ->where('status', 'confirmed')
                ->whereDate('appointment_date', '<', now()->toDateString())
                ->distinct('company_id')
                ->count()
        ];

        return response()->json($stats);
    }

    /**
     * Reschedule an appointment
     */
    public function reschedule(Request $request, $id)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), [
            'new_time_slot_id' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Ongeldige gegevens',
                'errors' => $validator->errors()
            ], 422);
        }

        $appointment = DB::table('appointments')
            ->where('id', $id)
            ->where('student_id', Auth::id())
            ->first();

        if (!$appointment) {
            return response()->json(['error' => 'Afspraak niet gevonden'], 404);
        }

        if ($appointment->status !== 'confirmed') {
            return response()->json(['error' => 'Alleen bevestigde afspraken kunnen worden verzet'], 422);
        }

        try {
            // Check if new time slot is available
            $appointmentCount = DB::table('appointments')
                ->where('time_slot_id', $request->new_time_slot_id)
                ->whereDate('appointment_date', $appointment->appointment_date)
                ->where('status', '!=', 'cancelled')
                ->count();

            if ($appointmentCount >= 20) {
                return response()->json([
                    'error' => 'Het nieuwe tijdslot is vol. Kies een ander tijdslot.'
                ], 422);
            }

            DB::table('appointments')
                ->where('id', $id)
                ->update([
                    'time_slot_id' => $request->new_time_slot_id,
                    'updated_at' => now()
                ]);

            Log::info('Appointment rescheduled', [
                'appointment_id' => $id,
                'old_time_slot' => $appointment->time_slot_id,
                'new_time_slot' => $request->new_time_slot_id,
                'student_id' => Auth::id()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Afspraak succesvol verzet'
            ]);

        } catch (\Exception $e) {
            Log::error('Error rescheduling appointment: ' . $e->getMessage(), [
                'appointment_id' => $id,
                'student_id' => Auth::id()
            ]);

            return response()->json([
                'error' => 'Er is een fout opgetreden bij het verzetten van de afspraak'
            ], 500);
        }
    }
}