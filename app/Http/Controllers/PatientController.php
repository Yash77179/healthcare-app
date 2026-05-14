<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    // List all patients
    public function index()
    {
        $patients = Patient::with('user', 'appointments', 'consultations')->paginate(15);
        return view('patients.index', compact('patients'));
    }

    // Show create patient form
    public function create()
    {
        return view('patients.create');
    }

    // Store a new patient
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date_of_birth' => 'required|date',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'postal_code' => 'required|string',
            'country' => 'required|string',
            'blood_type' => 'nullable|string',
            'emergency_contact' => 'required|string',
            'emergency_contact_phone' => 'required|string',
            'insurance_provider' => 'nullable|string',
            'insurance_policy_number' => 'nullable|string',
            'medical_history' => 'nullable|string',
            'allergies' => 'nullable|string',
            'current_medications' => 'nullable|string',
        ]);

        $patient = Patient::create($validated);
        return redirect()->route('patients.show', $patient)->with('success', 'Patient created successfully.');
    }

    // Show patient details
    public function show(Patient $patient)
    {
        $patient->load('user', 'appointments', 'consultations', 'medicalRecords');
        return view('patients.show', compact('patient'));
    }

    // Show edit patient form
    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    // Update patient
    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'date_of_birth' => 'required|date',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'postal_code' => 'required|string',
            'country' => 'required|string',
            'blood_type' => 'nullable|string',
            'emergency_contact' => 'required|string',
            'emergency_contact_phone' => 'required|string',
            'insurance_provider' => 'nullable|string',
            'insurance_policy_number' => 'nullable|string',
            'medical_history' => 'nullable|string',
            'allergies' => 'nullable|string',
            'current_medications' => 'nullable|string',
        ]);

        $patient->update($validated);
        return redirect()->route('patients.show', $patient)->with('success', 'Patient updated successfully.');
    }

    // Delete patient
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Patient deleted successfully.');
    }

    // Get patient's medical records
    public function medicalRecords(Patient $patient)
    {
        $records = $patient->medicalRecords()->paginate(10);
        return view('patients.medical-records', compact('patient', 'records'));
    }

    // Get patient's appointments
    public function appointments(Patient $patient)
    {
        $appointments = $patient->appointments()->paginate(10);
        return view('patients.appointments', compact('patient', 'appointments'));
    }

    // Get patient's consultations
    public function consultations(Patient $patient)
    {
        $consultations = $patient->consultations()->paginate(10);
        return view('patients.consultations', compact('patient', 'consultations'));
    }

    // API Methods - return JSON responses

    public function apiIndex()
    {
        $patients = Patient::with('user')->paginate(15);
        return response()->json($patients);
    }

    public function apiStore(Request $request)
    {
        $validated = $request->validate([
            'date_of_birth' => 'required|date',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'postal_code' => 'required|string',
            'country' => 'required|string',
            'blood_type' => 'nullable|string',
            'emergency_contact' => 'required|string',
            'emergency_contact_phone' => 'required|string',
            'insurance_provider' => 'nullable|string',
            'insurance_policy_number' => 'nullable|string',
            'medical_history' => 'nullable|array',
            'allergies' => 'nullable|array',
            'current_medications' => 'nullable|array',
        ]);

        $patient = Patient::create($validated);
        return response()->json(['message' => 'Patient created successfully', 'patient' => $patient], 201);
    }

    public function apiShow(Patient $patient)
    {
        $patient->load('user', 'appointments', 'consultations', 'medicalRecords');
        return response()->json($patient);
    }

    public function apiUpdate(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'date_of_birth' => 'required|date',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'postal_code' => 'required|string',
            'country' => 'required|string',
            'blood_type' => 'nullable|string',
            'emergency_contact' => 'required|string',
            'emergency_contact_phone' => 'required|string',
            'insurance_provider' => 'nullable|string',
            'insurance_policy_number' => 'nullable|string',
            'medical_history' => 'nullable|array',
            'allergies' => 'nullable|array',
            'current_medications' => 'nullable|array',
        ]);

        $patient->update($validated);
        return response()->json(['message' => 'Patient updated successfully', 'patient' => $patient]);
    }

    public function apiDestroy(Patient $patient)
    {
        $patient->delete();
        return response()->json(['message' => 'Patient deleted successfully']);
    }

    public function apiMedicalRecords(Patient $patient)
    {
        $records = $patient->medicalRecords()->paginate(10);
        return response()->json($records);
    }

    public function apiAppointments(Patient $patient)
    {
        $appointments = $patient->appointments()->paginate(10);
        return response()->json($appointments);
    }

    public function apiConsultations(Patient $patient)
    {
        $consultations = $patient->consultations()->paginate(10);
        return response()->json($consultations);
    }
}
