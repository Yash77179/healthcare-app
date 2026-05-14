@extends('layouts.app')

@section('title', 'Appointment Details')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Appointment Details</h1>
        <div class="space-x-2">
            @if($appointment->status !== 'confirmed')
                <form action="{{ route('appointments.confirm', $appointment) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-check mr-2"></i> Confirm
                    </button>
                </form>
            @endif
            <a href="{{ route('appointments.edit', $appointment) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('appointments.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back</a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Appointment Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Appointment Information</h2>
            <div class="space-y-2">
                <p><span class="font-medium">Date:</span> {{ $appointment->appointment_date }}</p>
                <p><span class="font-medium">Time:</span> {{ $appointment->appointment_time }}</p>
                <p><span class="font-medium">Duration:</span> {{ $appointment->duration_minutes }} minutes</p>
                <p><span class="font-medium">Reason for Visit:</span> {{ $appointment->reason_for_visit }}</p>
                <p>
                    <span class="font-medium">Status:</span>
                    <span class="px-3 py-1 rounded-full text-sm bg-{{ $appointment->status === 'confirmed' ? 'green' : 'yellow' }}-100 text-{{ $appointment->status === 'confirmed' ? 'green' : 'yellow' }}-800">
                        {{ ucfirst($appointment->status) }}
                    </span>
                </p>
            </div>
        </div>

        <!-- Patient Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Patient</h2>
            <div class="space-y-2">
                <p><span class="font-medium">Name:</span> {{ $appointment->patient->user->name ?? 'N/A' }}</p>
                <p><span class="font-medium">Phone:</span> {{ $appointment->patient->phone }}</p>
                <p><span class="font-medium">Email:</span> {{ $appointment->patient->user->email ?? 'N/A' }}</p>
                <a href="{{ route('patients.show', $appointment->patient) }}" class="text-blue-600 hover:underline">View Patient Profile</a>
            </div>
        </div>

        <!-- Doctor Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Doctor</h2>
            <div class="space-y-2">
                <p><span class="font-medium">Name:</span> {{ $appointment->doctor->user->name ?? 'N/A' }}</p>
                <p><span class="font-medium">Specialization:</span> {{ $appointment->doctor->specialization }}</p>
                <p><span class="font-medium">Phone:</span> {{ $appointment->doctor->phone }}</p>
                <a href="{{ route('doctors.show', $appointment->doctor) }}" class="text-blue-600 hover:underline">View Doctor Profile</a>
            </div>
        </div>

        <!-- Notes -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Notes</h2>
            <p class="text-gray-600">{{ $appointment->notes ?? 'No notes provided' }}</p>
        </div>
    </div>

    <!-- Related Consultation -->
    @if($appointment->consultation)
        <div class="mt-6 bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Related Consultation</h2>
            <p><a href="{{ route('consultations.show', $appointment->consultation) }}" class="text-blue-600 hover:underline">
                View Consultation Details
            </a></p>
        </div>
    @else
        <div class="mt-6 bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Create Consultation</h2>
            <p class="mb-4">No consultation recorded for this appointment yet.</p>
            <a href="{{ route('consultations.create') }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-plus mr-2"></i> Record Consultation
            </a>
        </div>
    @endif
</div>
@endsection
