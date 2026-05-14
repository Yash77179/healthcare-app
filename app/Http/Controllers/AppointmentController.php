<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    // List all appointments
    public function index()
    {
        $appointments = Appointment::with('patient', 'doctor')->paginate(15);
        return view('appointments.index', compact('appointments'));
    }

    // Show create appointment form
    public function create()
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        return view('appointments.create', compact('patients', 'doctors'));
    }

    // Store a new appointment
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => 'required|date_format:H:i',
            'duration_minutes' => 'required|integer|min:15|max:480',
            'reason_for_visit' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $appointment = Appointment::create($validated);
        return redirect()->route('appointments.show', $appointment)->with('success', 'Appointment created successfully.');
    }

    // Show appointment details
    public function show(Appointment $appointment)
    {
        $appointment->load('patient', 'doctor', 'consultation');
        return view('appointments.show', compact('appointment'));
    }

    // Show edit appointment form
    public function edit(Appointment $appointment)
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        return view('appointments.edit', compact('appointment', 'patients', 'doctors'));
    }

    // Update appointment
    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => 'required|date_format:H:i',
            'duration_minutes' => 'required|integer|min:15|max:480',
            'reason_for_visit' => 'required|string',
            'status' => 'required|in:scheduled,confirmed,completed,cancelled,no-show',
            'notes' => 'nullable|string',
        ]);

        $appointment->update($validated);
        return redirect()->route('appointments.show', $appointment)->with('success', 'Appointment updated successfully.');
    }

    // Delete appointment
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
    }

    // Cancel appointment
    public function cancel(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'cancellation_reason' => 'required|string',
        ]);

        $appointment->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
            'cancellation_reason' => $validated['cancellation_reason'],
        ]);

        return redirect()->route('appointments.show', $appointment)->with('success', 'Appointment cancelled successfully.');
    }

    // Confirm appointment
    public function confirm(Appointment $appointment)
    {
        $appointment->update(['status' => 'confirmed']);
        return redirect()->route('appointments.show', $appointment)->with('success', 'Appointment confirmed successfully.');
    }

    // Get upcoming appointments for a patient
    public function upcomingForPatient(Patient $patient)
    {
        $appointments = $patient->appointments()
            ->where('appointment_date', '>=', now())
            ->where('status', '!=', 'cancelled')
            ->orderBy('appointment_date', 'asc')
            ->paginate(10);
        return view('appointments.upcoming', compact('patient', 'appointments'));
    }

    // Get upcoming appointments for a doctor
    public function upcomingForDoctor(Doctor $doctor)
    {
        $appointments = $doctor->appointments()
            ->where('appointment_date', '>=', now())
            ->where('status', '!=', 'cancelled')
            ->orderBy('appointment_date', 'asc')
            ->paginate(10);
        return view('appointments.upcoming', compact('doctor', 'appointments'));
    }

    // API Methods - return JSON responses

    public function apiIndex()
    {
        $appointments = Appointment::with('patient', 'doctor')->paginate(15);
        return response()->json($appointments);
    }

    public function apiStore(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => 'required|date_format:H:i',
            'duration_minutes' => 'required|integer|min:15|max:480',
            'reason_for_visit' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $appointment = Appointment::create($validated);
        return response()->json(['message' => 'Appointment created successfully', 'appointment' => $appointment], 201);
    }

    public function apiShow(Appointment $appointment)
    {
        $appointment->load('patient', 'doctor', 'consultation');
        return response()->json($appointment);
    }

    public function apiUpdate(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => 'required|date_format:H:i',
            'duration_minutes' => 'required|integer|min:15|max:480',
            'reason_for_visit' => 'required|string',
            'status' => 'required|in:scheduled,confirmed,completed,cancelled,no-show',
            'notes' => 'nullable|string',
        ]);

        $appointment->update($validated);
        return response()->json(['message' => 'Appointment updated successfully', 'appointment' => $appointment]);
    }

    public function apiDestroy(Appointment $appointment)
    {
        $appointment->delete();
        return response()->json(['message' => 'Appointment deleted successfully']);
    }

    public function apiCancel(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'cancellation_reason' => 'required|string',
        ]);

        $appointment->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
            'cancellation_reason' => $validated['cancellation_reason'],
        ]);

        return response()->json(['message' => 'Appointment cancelled successfully', 'appointment' => $appointment]);
    }

    public function apiConfirm(Appointment $appointment)
    {
        $appointment->update(['status' => 'confirmed']);
        return response()->json(['message' => 'Appointment confirmed successfully', 'appointment' => $appointment]);
    }
}
