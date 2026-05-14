<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    // List all doctors
    public function index()
    {
        $doctors = Doctor::with('user', 'appointments', 'consultations')->paginate(15);
        return view('doctors.index', compact('doctors'));
    }

    // Show create doctor form
    public function create()
    {
        return view('doctors.create');
    }

    // Store a new doctor
    public function store(Request $request)
    {
        $validated = $request->validate([
            'specialization' => 'required|string',
            'license_number' => 'required|string|unique:doctors',
            'phone' => 'required|string|max:20',
            'office_address' => 'required|string',
            'office_city' => 'required|string',
            'office_state' => 'required|string',
            'office_postal_code' => 'required|string',
            'office_country' => 'required|string',
            'bio' => 'nullable|string',
            'years_of_experience' => 'nullable|integer',
            'qualifications' => 'nullable|string',
            'consultation_fee' => 'nullable|numeric|min:0',
            'availability_start_time' => 'nullable|date_format:H:i',
            'availability_end_time' => 'nullable|date_format:H:i',
            'available_days' => 'nullable|string',
        ]);

        $doctor = Doctor::create($validated);
        return redirect()->route('doctors.show', $doctor)->with('success', 'Doctor created successfully.');
    }

    // Show doctor details
    public function show(Doctor $doctor)
    {
        $doctor->load('user', 'appointments', 'consultations');
        return view('doctors.show', compact('doctor'));
    }

    // Show edit doctor form
    public function edit(Doctor $doctor)
    {
        return view('doctors.edit', compact('doctor'));
    }

    // Update doctor
    public function update(Request $request, Doctor $doctor)
    {
        $validated = $request->validate([
            'specialization' => 'required|string',
            'license_number' => 'required|string|unique:doctors,license_number,' . $doctor->id,
            'phone' => 'required|string|max:20',
            'office_address' => 'required|string',
            'office_city' => 'required|string',
            'office_state' => 'required|string',
            'office_postal_code' => 'required|string',
            'office_country' => 'required|string',
            'bio' => 'nullable|string',
            'years_of_experience' => 'nullable|integer',
            'qualifications' => 'nullable|string',
            'consultation_fee' => 'nullable|numeric|min:0',
            'availability_start_time' => 'nullable|date_format:H:i',
            'availability_end_time' => 'nullable|date_format:H:i',
            'available_days' => 'nullable|string',
        ]);

        $doctor->update($validated);
        return redirect()->route('doctors.show', $doctor)->with('success', 'Doctor updated successfully.');
    }

    // Delete doctor
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully.');
    }

    // Get doctor's appointments
    public function appointments(Doctor $doctor)
    {
        $appointments = $doctor->appointments()->paginate(10);
        return view('doctors.appointments', compact('doctor', 'appointments'));
    }

    // Get doctor's consultations
    public function consultations(Doctor $doctor)
    {
        $consultations = $doctor->consultations()->paginate(10);
        return view('doctors.consultations', compact('doctor', 'consultations'));
    }

    // Search doctors by specialization
    public function search(Request $request)
    {
        $specialization = $request->get('specialization');
        $doctors = Doctor::where('specialization', 'like', "%$specialization%")->paginate(15);
        return view('doctors.index', compact('doctors'));
    }

    // API Methods - return JSON responses

    public function apiIndex()
    {
        $doctors = Doctor::with('user')->paginate(15);
        return response()->json($doctors);
    }

    public function apiStore(Request $request)
    {
        $validated = $request->validate([
            'specialization' => 'required|string',
            'license_number' => 'required|string|unique:doctors',
            'phone' => 'required|string|max:20',
            'office_address' => 'required|string',
            'office_city' => 'required|string',
            'office_state' => 'required|string',
            'office_postal_code' => 'required|string',
            'office_country' => 'required|string',
            'bio' => 'nullable|string',
            'years_of_experience' => 'nullable|integer',
            'qualifications' => 'nullable|array',
            'consultation_fee' => 'nullable|numeric|min:0',
            'availability_start_time' => 'nullable|date_format:H:i',
            'availability_end_time' => 'nullable|date_format:H:i',
            'available_days' => 'nullable|array',
        ]);

        $doctor = Doctor::create($validated);
        return response()->json(['message' => 'Doctor created successfully', 'doctor' => $doctor], 201);
    }

    public function apiShow(Doctor $doctor)
    {
        $doctor->load('user', 'appointments', 'consultations');
        return response()->json($doctor);
    }

    public function apiUpdate(Request $request, Doctor $doctor)
    {
        $validated = $request->validate([
            'specialization' => 'required|string',
            'license_number' => 'required|string|unique:doctors,license_number,' . $doctor->id,
            'phone' => 'required|string|max:20',
            'office_address' => 'required|string',
            'office_city' => 'required|string',
            'office_state' => 'required|string',
            'office_postal_code' => 'required|string',
            'office_country' => 'required|string',
            'bio' => 'nullable|string',
            'years_of_experience' => 'nullable|integer',
            'qualifications' => 'nullable|array',
            'consultation_fee' => 'nullable|numeric|min:0',
            'availability_start_time' => 'nullable|date_format:H:i',
            'availability_end_time' => 'nullable|date_format:H:i',
            'available_days' => 'nullable|array',
        ]);

        $doctor->update($validated);
        return response()->json(['message' => 'Doctor updated successfully', 'doctor' => $doctor]);
    }

    public function apiDestroy(Doctor $doctor)
    {
        $doctor->delete();
        return response()->json(['message' => 'Doctor deleted successfully']);
    }

    public function apiAppointments(Doctor $doctor)
    {
        $appointments = $doctor->appointments()->paginate(10);
        return response()->json($appointments);
    }

    public function apiConsultations(Doctor $doctor)
    {
        $consultations = $doctor->consultations()->paginate(10);
        return response()->json($consultations);
    }

    public function apiSearch(Request $request)
    {
        $specialization = $request->get('specialization');
        $doctors = Doctor::where('specialization', 'like', "%$specialization%")->paginate(15);
        return response()->json($doctors);
    }
}
