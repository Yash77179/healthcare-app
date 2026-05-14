<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    // List all consultations
    public function index()
    {
        $consultations = Consultation::with('patient', 'doctor', 'appointment')->paginate(15);
        return view('consultations.index', compact('consultations'));
    }

    // Show create consultation form
    public function create()
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        $appointments = Appointment::where('status', 'confirmed')->get();
        return view('consultations.create', compact('patients', 'doctors', 'appointments'));
    }

    // Store a new consultation
    public function store(Request $request)
    {
        $validated = $request->validate([
            'appointment_id' => 'nullable|exists:appointments,id',
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'consultation_date' => 'required|date',
            'consultation_time' => 'required|date_format:H:i',
            'diagnosis' => 'nullable|string',
            'symptoms' => 'nullable|string',
            'treatment_plan' => 'nullable|string',
            'medications_prescribed' => 'nullable|string',
            'tests_recommended' => 'nullable|string',
            'follow_up_required' => 'nullable|boolean',
            'follow_up_date' => 'nullable|date',
            'consultation_type' => 'required|in:in-person,telehealth,video-call,phone',
            'consultation_notes' => 'nullable|string',
        ]);

        $consultation = Consultation::create($validated);
        return redirect()->route('consultations.show', $consultation)->with('success', 'Consultation created successfully.');
    }

    // Show consultation details
    public function show(Consultation $consultation)
    {
        $consultation->load('patient', 'doctor', 'appointment', 'medicalRecords');
        return view('consultations.show', compact('consultation'));
    }

    // Show edit consultation form
    public function edit(Consultation $consultation)
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        $appointments = Appointment::where('status', 'confirmed')->get();
        return view('consultations.edit', compact('consultation', 'patients', 'doctors', 'appointments'));
    }

    // Update consultation
    public function update(Request $request, Consultation $consultation)
    {
        $validated = $request->validate([
            'consultation_date' => 'required|date',
            'consultation_time' => 'required|date_format:H:i',
            'diagnosis' => 'nullable|string',
            'symptoms' => 'nullable|string',
            'treatment_plan' => 'nullable|string',
            'medications_prescribed' => 'nullable|string',
            'tests_recommended' => 'nullable|string',
            'follow_up_required' => 'nullable|boolean',
            'follow_up_date' => 'nullable|date',
            'consultation_type' => 'required|in:in-person,telehealth,video-call,phone',
            'consultation_notes' => 'nullable|string',
        ]);

        $consultation->update($validated);
        return redirect()->route('consultations.show', $consultation)->with('success', 'Consultation updated successfully.');
    }

    // Delete consultation
    public function destroy(Consultation $consultation)
    {
        $consultation->delete();
        return redirect()->route('consultations.index')->with('success', 'Consultation deleted successfully.');
    }

    // Get patient's consultation history
    public function patientHistory(Patient $patient)
    {
        $consultations = $patient->consultations()->orderBy('consultation_date', 'desc')->paginate(10);
        return view('consultations.patient-history', compact('patient', 'consultations'));
    }

    // Get doctor's consultation history
    public function doctorHistory(Doctor $doctor)
    {
        $consultations = $doctor->consultations()->orderBy('consultation_date', 'desc')->paginate(10);
        return view('consultations.doctor-history', compact('doctor', 'consultations'));
    }

    // API Methods - return JSON responses

    public function apiIndex()
    {
        $consultations = Consultation::with('patient', 'doctor', 'appointment')->paginate(15);
        return response()->json($consultations);
    }

    public function apiStore(Request $request)
    {
        $validated = $request->validate([
            'appointment_id' => 'nullable|exists:appointments,id',
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'consultation_date' => 'required|date',
            'consultation_time' => 'required|date_format:H:i',
            'diagnosis' => 'nullable|string',
            'symptoms' => 'nullable|array',
            'treatment_plan' => 'nullable|string',
            'medications_prescribed' => 'nullable|array',
            'tests_recommended' => 'nullable|array',
            'follow_up_required' => 'nullable|boolean',
            'follow_up_date' => 'nullable|date',
            'consultation_type' => 'required|in:in-person,telehealth,video-call,phone',
            'consultation_notes' => 'nullable|string',
        ]);

        $consultation = Consultation::create($validated);
        return response()->json(['message' => 'Consultation created successfully', 'consultation' => $consultation], 201);
    }

    public function apiShow(Consultation $consultation)
    {
        $consultation->load('patient', 'doctor', 'appointment', 'medicalRecords');
        return response()->json($consultation);
    }

    public function apiUpdate(Request $request, Consultation $consultation)
    {
        $validated = $request->validate([
            'consultation_date' => 'required|date',
            'consultation_time' => 'required|date_format:H:i',
            'diagnosis' => 'nullable|string',
            'symptoms' => 'nullable|array',
            'treatment_plan' => 'nullable|string',
            'medications_prescribed' => 'nullable|array',
            'tests_recommended' => 'nullable|array',
            'follow_up_required' => 'nullable|boolean',
            'follow_up_date' => 'nullable|date',
            'consultation_type' => 'required|in:in-person,telehealth,video-call,phone',
            'consultation_notes' => 'nullable|string',
        ]);

        $consultation->update($validated);
        return response()->json(['message' => 'Consultation updated successfully', 'consultation' => $consultation]);
    }

    public function apiDestroy(Consultation $consultation)
    {
        $consultation->delete();
        return response()->json(['message' => 'Consultation deleted successfully']);
    }
}
