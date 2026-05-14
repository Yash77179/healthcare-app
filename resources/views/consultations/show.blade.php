@extends('layouts.app')

@section('title', 'Consultation Details')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Consultation Details</h1>
        <div class="space-x-2">
            <a href="{{ route('consultations.edit', $consultation) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('consultations.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back</a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Basic Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Basic Information</h2>
            <div class="space-y-2">
                <p><span class="font-medium">Date:</span> {{ $consultation->consultation_date }}</p>
                <p><span class="font-medium">Time:</span> {{ $consultation->consultation_time }}</p>
                <p><span class="font-medium">Type:</span> <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm">{{ ucfirst($consultation->consultation_type) }}</span></p>
            </div>
        </div>

        <!-- Patient Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Patient</h2>
            <div class="space-y-2">
                <p><span class="font-medium">Name:</span> {{ $consultation->patient->user->name ?? 'N/A' }}</p>
                <p><span class="font-medium">Phone:</span> {{ $consultation->patient->phone }}</p>
                <a href="{{ route('patients.show', $consultation->patient) }}" class="text-blue-600 hover:underline">View Patient Profile</a>
            </div>
        </div>

        <!-- Doctor Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Doctor</h2>
            <div class="space-y-2">
                <p><span class="font-medium">Name:</span> {{ $consultation->doctor->user->name ?? 'N/A' }}</p>
                <p><span class="font-medium">Specialization:</span> {{ $consultation->doctor->specialization }}</p>
                <a href="{{ route('doctors.show', $consultation->doctor) }}" class="text-blue-600 hover:underline">View Doctor Profile</a>
            </div>
        </div>

        <!-- Diagnosis -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Diagnosis</h2>
            <p class="text-gray-600">{{ $consultation->diagnosis ?? 'Not specified' }}</p>
        </div>

        <!-- Symptoms -->
        <div class="bg-white rounded-lg shadow p-6 md:col-span-2">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Symptoms</h2>
            <p class="text-gray-600">{{ implode(', ', $consultation->symptoms ?? []) ?: 'None recorded' }}</p>
        </div>

        <!-- Treatment Plan -->
        <div class="bg-white rounded-lg shadow p-6 md:col-span-2">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Treatment Plan</h2>
            <p class="text-gray-600">{{ $consultation->treatment_plan ?? 'Not specified' }}</p>
        </div>

        <!-- Medications -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Medications Prescribed</h2>
            <p class="text-gray-600">{{ implode(', ', $consultation->medications_prescribed ?? []) ?: 'None' }}</p>
        </div>

        <!-- Tests -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Tests Recommended</h2>
            <p class="text-gray-600">{{ implode(', ', $consultation->tests_recommended ?? []) ?: 'None' }}</p>
        </div>

        <!-- Follow-up -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Follow-up</h2>
            <div class="space-y-2">
                <p><span class="font-medium">Required:</span> {{ $consultation->follow_up_required ? 'Yes' : 'No' }}</p>
                @if($consultation->follow_up_required)
                    <p><span class="font-medium">Date:</span> {{ $consultation->follow_up_date ?? 'Not scheduled' }}</p>
                @endif
            </div>
        </div>

        <!-- Notes -->
        <div class="bg-white rounded-lg shadow p-6 md:col-span-2">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Consultation Notes</h2>
            <p class="text-gray-600">{{ $consultation->consultation_notes ?? 'No notes' }}</p>
        </div>
    </div>

    <!-- Related Appointment -->
    @if($consultation->appointment)
        <div class="mt-6 bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Related Appointment</h2>
            <a href="{{ route('appointments.show', $consultation->appointment) }}" class="text-blue-600 hover:underline">
                View Appointment Details
            </a>
        </div>
    @endif

    <!-- Related Medical Records -->
    @if($consultation->medicalRecords->count() > 0)
        <div class="mt-6 bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Related Medical Records</h2>
            <div class="space-y-2">
                @foreach($consultation->medicalRecords as $record)
                    <a href="{{ route('medical-records.show', $record) }}" class="block text-blue-600 hover:underline">
                        {{ $record->record_type }} - {{ $record->record_date }}
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
