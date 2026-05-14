<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    // List all medical records
    public function index()
    {
        $records = MedicalRecord::with('patient', 'doctor', 'consultation')->paginate(15);
        return view('medical-records.index', compact('records'));
    }

    // Show create medical record form
    public function create()
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        return view('medical-records.create', compact('patients', 'doctors'));
    }

    // Store a new medical record
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'nullable|exists:doctors,id',
            'record_type' => 'required|string',
            'record_date' => 'required|date',
            'description' => 'nullable|string',
            'findings' => 'nullable|string',
            'recommendations' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'visibility' => 'required|in:private,shared_with_doctor,shared_with_patient,public',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('medical_records', 'public');
            $validated['file_path'] = $path;
            $validated['file_name'] = $file->getClientOriginalName();
        }

        $validated['created_by'] = auth()->id() ?? 1;
        $record = MedicalRecord::create($validated);

        return redirect()->route('medical-records.show', $record)->with('success', 'Medical record created successfully.');
    }

    // Show medical record details
    public function show(MedicalRecord $record)
    {
        $record->load('patient', 'doctor', 'consultation');
        return view('medical-records.show', compact('record'));
    }

    // Show edit medical record form
    public function edit(MedicalRecord $record)
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        return view('medical-records.edit', compact('record', 'patients', 'doctors'));
    }

    // Update medical record
    public function update(Request $request, MedicalRecord $record)
    {
        $validated = $request->validate([
            'record_type' => 'required|string',
            'record_date' => 'required|date',
            'description' => 'nullable|string',
            'findings' => 'nullable|string',
            'recommendations' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'visibility' => 'required|in:private,shared_with_doctor,shared_with_patient,public',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('medical_records', 'public');
            $validated['file_path'] = $path;
            $validated['file_name'] = $file->getClientOriginalName();
        }

        $record->update($validated);
        return redirect()->route('medical-records.show', $record)->with('success', 'Medical record updated successfully.');
    }

    // Delete medical record
    public function destroy(MedicalRecord $record)
    {
        $record->delete();
        return redirect()->route('medical-records.index')->with('success', 'Medical record deleted successfully.');
    }

    // Get patient's medical records
    public function patientRecords(Patient $patient)
    {
        $records = $patient->medicalRecords()->paginate(10);
        return view('medical-records.patient-records', compact('patient', 'records'));
    }

    // Download medical record file
    public function download(MedicalRecord $record)
    {
        if (!$record->file_path) {
            return redirect()->back()->with('error', 'No file associated with this record.');
        }

        return response()->download(storage_path('app/public/' . $record->file_path), $record->file_name);
    }

    // API Methods - return JSON responses

    public function apiIndex()
    {
        $records = MedicalRecord::with('patient', 'doctor', 'consultation')->paginate(15);
        return response()->json($records);
    }

    public function apiStore(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'nullable|exists:doctors,id',
            'record_type' => 'required|string',
            'record_date' => 'required|date',
            'description' => 'nullable|string',
            'findings' => 'nullable|array',
            'recommendations' => 'nullable|array',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'visibility' => 'required|in:private,shared_with_doctor,shared_with_patient,public',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('medical_records', 'public');
            $validated['file_path'] = $path;
            $validated['file_name'] = $file->getClientOriginalName();
        }

        $validated['created_by'] = auth()->id() ?? 1;
        $record = MedicalRecord::create($validated);

        return response()->json(['message' => 'Medical record created successfully', 'record' => $record], 201);
    }

    public function apiShow(MedicalRecord $record)
    {
        $record->load('patient', 'doctor', 'consultation');
        return response()->json($record);
    }

    public function apiUpdate(Request $request, MedicalRecord $record)
    {
        $validated = $request->validate([
            'record_type' => 'required|string',
            'record_date' => 'required|date',
            'description' => 'nullable|string',
            'findings' => 'nullable|array',
            'recommendations' => 'nullable|array',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'visibility' => 'required|in:private,shared_with_doctor,shared_with_patient,public',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('medical_records', 'public');
            $validated['file_path'] = $path;
            $validated['file_name'] = $file->getClientOriginalName();
        }

        $record->update($validated);
        return response()->json(['message' => 'Medical record updated successfully', 'record' => $record]);
    }

    public function apiDestroy(MedicalRecord $record)
    {
        $record->delete();
        return response()->json(['message' => 'Medical record deleted successfully']);
    }

    public function apiDownload(MedicalRecord $record)
    {
        if (!$record->file_path) {
            return response()->json(['error' => 'No file associated with this record'], 404);
        }

        return response()->download(storage_path('app/public/' . $record->file_path), $record->file_name);
    }
}
