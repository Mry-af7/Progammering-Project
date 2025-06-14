<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\TimeSlotController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public routes
Route::get('/companies', [CompanyController::class, 'index']);
Route::get('/time-slots', [TimeSlotController::class, 'index']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/appointments', [AppointmentController::class, 'index']);
    Route::post('/appointments', [AppointmentController::class, 'store']);
    Route::get('/appointments/{appointment}', [AppointmentController::class, 'show']);
    Route::put('/appointments/{appointment}', [AppointmentController::class, 'update']);
    Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy']);
    Route::post('/appointments/{appointment}/reschedule', [AppointmentController::class, 'reschedule']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/time-slots', [TimeSlotController::class, 'store']);
    Route::put('/time-slots/{timeSlot}', [TimeSlotController::class, 'update']);
    Route::delete('/time-slots/{timeSlot}', [TimeSlotController::class, 'destroy']);
}); 