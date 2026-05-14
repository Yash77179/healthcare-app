@extends('layouts.app')

@section('title', 'Patient Details')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">{{ $patient->user->name ?? 'Patient' }}</h1>
        <div class="space-x-2">
            <a href="{{ route('patients.edit', $patient) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('patients.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back</a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Personal Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Personal Information</h2>
            <div class="space-y-2">
                <p><span class="font-medium">Date of Birth:</span> {{ $patient->date_of_birth }}</p>
                <p><span class="font-medium">Phone:</span> {{ $patient->phone }}</p>
                <p><span class="font-medium">Address:</span> {{ $patient->address }}, {{ $patient->city }}, {{ $patient->state }} {{ $patient->postal_code }}</p>
                <p><span class="font-medium">Country:</span> {{ $patient->country }}</p>
                <p><span class="font-medium">Blood Type:</span> <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded">{{ $patient->blood_type ?? 'N/A' }}</span></p>
            </div>
        </div>

        <!-- Emergency Contact -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Emergency Contact</h2>
            <div class="space-y-2">
                <p><span class="font-medium">Name:</span> {{ $patient->emergency_contact }}</p>
                <p><span class="font-medium">Phone:</span> {{ $patient->emergency_contact_phone }}</p>
            </div>
        </div>

        <!-- Insurance Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Insurance Information</h2>
            <div class="space-y-2">
                <p><span class="font-medium">Provider:</span> {{ $patient->insurance_provider ?? 'N/A' }}</p>
                <p><span class="font-medium">Policy Number:</span> {{ $patient->insurance_policy_number ?? 'N/A' }}</p>
            </div>
        </div>

        <!-- Medical History -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Medical Info</h2>
            <div class="space-y-2">
                <p><span class="font-medium">Medical History:</span></p>
                <p class="text-sm text-gray-600">{{ implode(', ', $patient->medical_history ?? []) ?: 'None' }}</p>
                <p><span class="font-medium">Allergies:</span></p>
                <p class="text-sm text-gray-600">{{ implode(', ', $patient->allergies ?? []) ?: 'None' }}</p>
            </div>
        </div>

        <!-- Current Medications -->
        <div class="bg-white rounded-lg shadow p-6 md:col-span-2">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Current Medications</h2>
            <p class="text-sm text-gray-600">{{ implode(', ', $patient->current_medications ?? []) ?: 'None' }}</p>
        </div>
    </div>

    <!-- Tabs for Related Data -->
    <div class="mt-6 bg-white rounded-lg shadow p-6">
        <div class="border-b border-gray-200 mb-4">
            <nav class="flex space-x-8">
                <button onclick="showTab('appointments')" class="tab-button px-1 py-2 border-b-2 border-blue-500 text-blue-600 font-medium">
                    <i class="fas fa-calendar mr-2"></i> Appointments
                </button>
                <button onclick="showTab('consultations')" class="tab-button px-1 py-2 border-b-2 border-gray-300 text-gray-600 font-medium">
                    <i class="fas fa-stethoscope mr-2"></i> Consultations
                </button>
                <button onclick="showTab('records')" class="tab-button px-1 py-2 border-b-2 border-gray-300 text-gray-600 font-medium">
                    <i class="fas fa-file-medical mr-2"></i> Medical Records
                </button>
            </nav>
        </div>

        <!-- Appointments Tab -->
        <div id="appointments" class="tab-content">
            <h3 class="text-lg font-semibold mb-3">Appointments</h3>
            @forelse($patient->appointments as $appointment)
                <div class="mb-3 p-3 bg-gray-50 rounded">
                    <p class="font-medium">{{ $appointment->doctor->user->name ?? 'N/A' }}</p>
                    <p class="text-sm text-gray-600">{{ $appointment->appointment_date }} at {{ $appointment->appointment_time }}</p>
                    <span class="inline-block mt-2 px-3 py-1 text-xs rounded bg-blue-100 text-blue-800">{{ ucfirst($appointment->status) }}</span>
                </div>
            @empty
                <p class="text-gray-600">No appointments</p>
            @endforelse
        </div>

        <!-- Consultations Tab -->
        <div id="consultations" class="tab-content hidden">
            <h3 class="text-lg font-semibold mb-3">Consultations</h3>
            @forelse($patient->consultations as $consultation)
                <div class="mb-3 p-3 bg-gray-50 rounded">
                    <p class="font-medium">{{ $consultation->doctor->user->name ?? 'N/A' }}</p>
                    <p class="text-sm text-gray-600">{{ $consultation->consultation_date }}</p>
                    <p class="text-sm"><span class="font-medium">Diagnosis:</span> {{ $consultation->diagnosis ?? 'N/A' }}</p>
                </div>
            @empty
                <p class="text-gray-600">No consultations</p>
            @endforelse
        </div>

        <!-- Medical Records Tab -->
        <div id="records" class="tab-content hidden">
            <h3 class="text-lg font-semibold mb-3">Medical Records</h3>
            @forelse($patient->medicalRecords as $record)
                <div class="mb-3 p-3 bg-gray-50 rounded">
                    <p class="font-medium">{{ $record->record_type }}</p>
                    <p class="text-sm text-gray-600">{{ $record->record_date }}</p>
                    <p class="text-sm">{{ $record->description }}</p>
                </div>
            @empty
                <p class="text-gray-600">No medical records</p>
            @endforelse
        </div>
    </div>
</div>

<script>
function showTab(tabName) {
    const tabs = document.querySelectorAll('.tab-content');
    tabs.forEach(tab => tab.classList.add('hidden'));
    document.getElementById(tabName).classList.remove('hidden');

    const buttons = document.querySelectorAll('.tab-button');
    buttons.forEach(btn => {
        btn.classList.remove('border-blue-500', 'text-blue-600');
        btn.classList.add('border-gray-300', 'text-gray-600');
    });
    event.target.classList.remove('border-gray-300', 'text-gray-600');
    event.target.classList.add('border-blue-500', 'text-blue-600');
}
</script>
@endsection
