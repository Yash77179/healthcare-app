<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\MedicalRecordController;

// API Routes - protected by Sanctum auth
Route::middleware(['auth:sanctum'])->group(function () {

    // Patient API Routes
    Route::get('/patients', [PatientController::class, 'apiIndex']);
    Route::post('/patients', [PatientController::class, 'apiStore']);
    Route::get('/patients/{patient}', [PatientController::class, 'apiShow']);
    Route::put('/patients/{patient}', [PatientController::class, 'apiUpdate']);
    Route::delete('/patients/{patient}', [PatientController::class, 'apiDestroy']);
    Route::get('/patients/{patient}/medical-records', [PatientController::class, 'apiMedicalRecords']);
    Route::get('/patients/{patient}/appointments', [PatientController::class, 'apiAppointments']);
    Route::get('/patients/{patient}/consultations', [PatientController::class, 'apiConsultations']);

    // Doctor API Routes
    Route::get('/doctors', [DoctorController::class, 'apiIndex']);
    Route::post('/doctors', [DoctorController::class, 'apiStore']);
    Route::get('/doctors/{doctor}', [DoctorController::class, 'apiShow']);
    Route::put('/doctors/{doctor}', [DoctorController::class, 'apiUpdate']);
    Route::delete('/doctors/{doctor}', [DoctorController::class, 'apiDestroy']);
    Route::get('/doctors/{doctor}/appointments', [DoctorController::class, 'apiAppointments']);
    Route::get('/doctors/{doctor}/consultations', [DoctorController::class, 'apiConsultations']);
    Route::get('/doctors/search', [DoctorController::class, 'apiSearch']);

    // Appointment API Routes
    Route::get('/appointments', [AppointmentController::class, 'apiIndex']);
    Route::post('/appointments', [AppointmentController::class, 'apiStore']);
    Route::get('/appointments/{appointment}', [AppointmentController::class, 'apiShow']);
    Route::put('/appointments/{appointment}', [AppointmentController::class, 'apiUpdate']);
    Route::delete('/appointments/{appointment}', [AppointmentController::class, 'apiDestroy']);
    Route::post('/appointments/{appointment}/cancel', [AppointmentController::class, 'apiCancel']);
    Route::post('/appointments/{appointment}/confirm', [AppointmentController::class, 'apiConfirm']);

    // Consultation API Routes
    Route::get('/consultations', [ConsultationController::class, 'apiIndex']);
    Route::post('/consultations', [ConsultationController::class, 'apiStore']);
    Route::get('/consultations/{consultation}', [ConsultationController::class, 'apiShow']);
    Route::put('/consultations/{consultation}', [ConsultationController::class, 'apiUpdate']);
    Route::delete('/consultations/{consultation}', [ConsultationController::class, 'apiDestroy']);

    // Medical Record API Routes
    Route::get('/medical-records', [MedicalRecordController::class, 'apiIndex']);
    Route::post('/medical-records', [MedicalRecordController::class, 'apiStore']);
    Route::get('/medical-records/{record}', [MedicalRecordController::class, 'apiShow']);
    Route::put('/medical-records/{record}', [MedicalRecordController::class, 'apiUpdate']);
    Route::delete('/medical-records/{record}', [MedicalRecordController::class, 'apiDestroy']);
    Route::get('/medical-records/{record}/download', [MedicalRecordController::class, 'apiDownload']);
});

// Public API routes (if needed)
Route::get('/health', function () {
    return response()->json(['status' => 'ok', 'timestamp' => now()]);
});
