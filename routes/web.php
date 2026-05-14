<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\MedicalRecordController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Patient routes
Route::resource('patients', PatientController::class);
Route::get('/patients/{patient}/medical-records', [PatientController::class, 'medicalRecords'])->name('patients.medical-records');
Route::get('/patients/{patient}/appointments', [PatientController::class, 'appointments'])->name('patients.appointments');
Route::get('/patients/{patient}/consultations', [PatientController::class, 'consultations'])->name('patients.consultations');

// Doctor routes
Route::resource('doctors', DoctorController::class);
Route::get('/doctors/{doctor}/appointments', [DoctorController::class, 'appointments'])->name('doctors.appointments');
Route::get('/doctors/{doctor}/consultations', [DoctorController::class, 'consultations'])->name('doctors.consultations');
Route::get('/doctors/search', [DoctorController::class, 'search'])->name('doctors.search');

// Appointment routes
Route::resource('appointments', AppointmentController::class);
Route::post('/appointments/{appointment}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');
Route::post('/appointments/{appointment}/confirm', [AppointmentController::class, 'confirm'])->name('appointments.confirm');
Route::get('/patients/{patient}/appointments/upcoming', [AppointmentController::class, 'upcomingForPatient'])->name('appointments.upcoming.patient');
Route::get('/doctors/{doctor}/appointments/upcoming', [AppointmentController::class, 'upcomingForDoctor'])->name('appointments.upcoming.doctor');

// Consultation routes
Route::resource('consultations', ConsultationController::class);
Route::get('/patients/{patient}/consultations/history', [ConsultationController::class, 'patientHistory'])->name('consultations.patient-history');
Route::get('/doctors/{doctor}/consultations/history', [ConsultationController::class, 'doctorHistory'])->name('consultations.doctor-history');

// Medical Record routes
Route::resource('medical-records', MedicalRecordController::class);
Route::get('/patients/{patient}/medical-records', [MedicalRecordController::class, 'patientRecords'])->name('medical-records.patient-records');
Route::get('/medical-records/{record}/download', [MedicalRecordController::class, 'download'])->name('medical-records.download');
