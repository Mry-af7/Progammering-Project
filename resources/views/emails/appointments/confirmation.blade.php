@component('mail::message')
# Bevestiging afspraak

Beste {{ $appointment->student_firstname }},

Bedankt voor je aanmelding voor een gesprek met {{ $company->name }}. Hier zijn de details van je afspraak:

**Datum:** {{ $timeSlot->start_time->format('d/m/Y') }}  
**Tijd:** {{ $timeSlot->start_time->format('H:i') }} - {{ $timeSlot->end_time->format('H:i') }}  
**Locatie:** {{ $timeSlot->location }}  
**Ruimte:** {{ $timeSlot->room_number }}

**Je gegevens:**  
Naam: {{ $appointment->student_firstname }} {{ $appointment->student_lastname }}  
E-mail: {{ $appointment->student_email }}  
Telefoon: {{ $appointment->student_phone }}  
Studierichting: {{ $appointment->study_field }}  
Studiejaar: {{ $appointment->study_year }}

**Onderwerp gesprek:**  
{{ $appointment->student_notes }}

@if($appointment->status === 'pending')
Je afspraak is momenteel in behandeling. Je ontvangt een nieuwe bevestiging zodra deze is goedgekeurd.
@endif

**Belangrijke informatie:**
- Zorg dat je 5 minuten voor aanvang aanwezig bent
- Neem je studentenkaart mee
- Bereid je voor op het gesprek door de website van {{ $company->name }} te bekijken
- Heb je vragen? Neem dan contact op met de organisatie

@if($appointment->status === 'pending')
@component('mail::button', ['url' => route('appointments.show', $appointment)])
Bekijk afspraak
@endcomponent
@endif

Met vriendelijke groet,<br>
{{ config('app.name') }}
@endcomponent 