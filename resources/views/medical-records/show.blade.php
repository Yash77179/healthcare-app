@extends('layouts.app')

@section('title', 'Medical Record Details')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">{{ $record->record_type }}</h1>
        <div class="space-x-2">
            <a href="{{ route('medical-records.edit', $record) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-edit"></i> Edit
            </a>
            @if($record->file_path)
                <a href="{{ route('medical-records.download', $record) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-download"></i> Download
                </a>
            @endif
            <a href="{{ route('medical-records.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back</a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Record Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Record Information</h2>
            <div class="space-y-2">
                <p><span class="font-medium">Type:</span> {{ $record->record_type }}</p>
                <p><span class="font-medium">Date:</span> {{ $record->record_date }}</p>
                <p>
                    <span class="font-medium">Visibility:</span>
                    <span class="px-3 py-1 bg-red-100 text-red-800 text-sm rounded-full">
                        {{ ucfirst(str_replace('_', ' ', $record->visibility)) }}
                    </span>
                </p>
            </div>
        </div>

        <!-- Patient Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Patient</h2>
            <div class="space-y-2">
                <p><span class="font-medium">Name:</span> {{ $record->patient->user->name ?? 'N/A' }}</p>
                <p><span class="font-medium">Phone:</span> {{ $record->patient->phone }}</p>
                <a href="{{ route('patients.show', $record->patient) }}" class="text-blue-600 hover:underline">View Patient Profile</a>
            </div>
        </div>

        <!-- Doctor Information -->
        @if($record->doctor)
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Doctor</h2>
                <div class="space-y-2">
                    <p><span class="font-medium">Name:</span> {{ $record->doctor->user->name ?? 'N/A' }}</p>
                    <p><span class="font-medium">Specialization:</span> {{ $record->doctor->specialization }}</p>
                    <a href="{{ route('doctors.show', $record->doctor) }}" class="text-blue-600 hover:underline">View Doctor Profile</a>
                </div>
            </div>
        @endif

        <!-- File Information -->
        @if($record->file_path)
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Attached File</h2>
                <div class="space-y-2">
                    <p><span class="font-medium">File Name:</span> {{ $record->file_name }}</p>
                    <a href="{{ route('medical-records.download', $record) }}" class="inline-block px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700">
                        <i class="fas fa-download mr-2"></i> Download File
                    </a>
                </div>
            </div>
        @endif

        <!-- Description -->
        <div class="bg-white rounded-lg shadow p-6 md:col-span-2">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Description</h2>
            <p class="text-gray-600">{{ $record->description ?? 'No description' }}</p>
        </div>

        <!-- Findings -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Findings</h2>
            <p class="text-gray-600">{{ implode(', ', $record->findings ?? []) ?: 'None recorded' }}</p>
        </div>

        <!-- Recommendations -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Recommendations</h2>
            <p class="text-gray-600">{{ implode(', ', $record->recommendations ?? []) ?: 'None recorded' }}</p>
        </div>
    </div>

    <!-- Related Consultation -->
    @if($record->consultation)
        <div class="mt-6 bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Related Consultation</h2>
            <a href="{{ route('consultations.show', $record->consultation) }}" class="text-blue-600 hover:underline">
                View Consultation Details - {{ $record->consultation->consultation_date }}
            </a>
        </div>
    @endif
</div>
@endsection
