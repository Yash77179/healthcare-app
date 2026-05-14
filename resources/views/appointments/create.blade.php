@extends('layouts.app')

@section('title', isset($appointment) ? 'Edit Appointment' : 'Schedule Appointment')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <p class="text-slate-500 text-sm font-medium mb-1">{{ isset($appointment) ? 'Update appointment details' : 'Book a new appointment' }}</p>
        <h1 class="text-3xl font-bold text-slate-800">{{ isset($appointment) ? 'Edit Appointment' : 'Schedule Appointment' }}</h1>
    </div>

    <form action="{{ isset($appointment) ? route('appointments.update', $appointment) : route('appointments.store') }}" method="POST" class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8">
        @csrf
        @if(isset($appointment))
            @method('PUT')
        @endif

        <div class="space-y-8">
            <!-- People -->
            <div>
                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-4 flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center"><i class="fas fa-users text-blue-600 text-xs"></i></div>
                    Patient & Doctor
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="patient_id" class="block text-sm font-semibold text-slate-700 mb-2">Patient</label>
                        <select name="patient_id" id="patient_id" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all bg-white" required>
                            <option value="">Select Patient</option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}" {{ isset($appointment) && $appointment->patient_id === $patient->id ? 'selected' : '' }}>
                                    {{ $patient->user->name ?? 'N/A' }}
                                </option>
                            @endforeach
                        </select>
                        @error('patient_id')<p class="text-rose-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="doctor_id" class="block text-sm font-semibold text-slate-700 mb-2">Doctor</label>
                        <select name="doctor_id" id="doctor_id" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all bg-white" required>
                            <option value="">Select Doctor</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}" {{ isset($appointment) && $appointment->doctor_id === $doctor->id ? 'selected' : '' }}>
                                    {{ $doctor->user->name ?? 'N/A' }} - {{ $doctor->specialization }}
                                </option>
                            @endforeach
                        </select>
                        @error('doctor_id')<p class="text-rose-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            <!-- Date & Time -->
            <div>
                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-4 flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-amber-50 flex items-center justify-center"><i class="fas fa-calendar-day text-amber-600 text-xs"></i></div>
                    Date & Time
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div>
                        <label for="appointment_date" class="block text-sm font-semibold text-slate-700 mb-2">Date</label>
                        <input type="date" name="appointment_date" id="appointment_date"
                            value="{{ isset($appointment) ? $appointment->appointment_date : old('appointment_date') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all" required>
                        @error('appointment_date')<p class="text-rose-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="appointment_time" class="block text-sm font-semibold text-slate-700 mb-2">Time</label>
                        <input type="time" name="appointment_time" id="appointment_time"
                            value="{{ isset($appointment) ? $appointment->appointment_time : old('appointment_time') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all" required>
                        @error('appointment_time')<p class="text-rose-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="duration_minutes" class="block text-sm font-semibold text-slate-700 mb-2">Duration</label>
                        <select name="duration_minutes" id="duration_minutes" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all bg-white" required>
                            <option value="15" {{ isset($appointment) && $appointment->duration_minutes === 15 ? 'selected' : '' }}>15 min</option>
                            <option value="30" {{ isset($appointment) && $appointment->duration_minutes === 30 ? 'selected' : '' }}>30 min</option>
                            <option value="45" {{ isset($appointment) && $appointment->duration_minutes === 45 ? 'selected' : '' }}>45 min</option>
                            <option value="60" {{ isset($appointment) && $appointment->duration_minutes === 60 ? 'selected' : '' }}>1 hour</option>
                            <option value="90" {{ isset($appointment) && $appointment->duration_minutes === 90 ? 'selected' : '' }}>1.5 hours</option>
                            <option value="120" {{ isset($appointment) && $appointment->duration_minutes === 120 ? 'selected' : '' }}>2 hours</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Status & Reason -->
            <div>
                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-4 flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center"><i class="fas fa-clipboard-list text-emerald-600 text-xs"></i></div>
                    Details
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="status" class="block text-sm font-semibold text-slate-700 mb-2">Status</label>
                        <select name="status" id="status" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all bg-white">
                            <option value="scheduled" {{ isset($appointment) && $appointment->status === 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                            <option value="confirmed" {{ isset($appointment) && $appointment->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="completed" {{ isset($appointment) && $appointment->status === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ isset($appointment) && $appointment->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label for="reason_for_visit" class="block text-sm font-semibold text-slate-700 mb-2">Reason for Visit</label>
                        <input type="text" name="reason_for_visit" id="reason_for_visit"
                            value="{{ isset($appointment) ? $appointment->reason_for_visit : old('reason_for_visit') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all" required>
                        @error('reason_for_visit')<p class="text-rose-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="md:col-span-2">
                        <label for="notes" class="block text-sm font-semibold text-slate-700 mb-2">Notes</label>
                        <textarea name="notes" id="notes" rows="3"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all resize-y">{{ isset($appointment) ? $appointment->notes : old('notes') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-slate-100 flex items-center gap-3">
            <button type="submit" class="btn-primary px-6 py-2.5 rounded-xl text-sm font-semibold shadow-lg shadow-teal-500/25">
                {{ isset($appointment) ? 'Update Appointment' : 'Schedule Appointment' }}
            </button>
            <a href="{{ route('appointments.index') }}" class="px-6 py-2.5 rounded-xl bg-slate-100 text-slate-600 text-sm font-semibold hover:bg-slate-200 transition-colors">Cancel</a>
        </div>
    </form>
</div>
@endsection
