@extends('layouts.app')

@section('title', isset($consultation) ? 'Edit Consultation' : 'Record Consultation')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <p class="text-slate-500 text-sm font-medium mb-1">{{ isset($consultation) ? 'Update consultation' : 'Record a new consultation' }}</p>
        <h1 class="text-3xl font-bold text-slate-800">{{ isset($consultation) ? 'Edit Consultation' : 'Record Consultation' }}</h1>
    </div>

    <form action="{{ isset($consultation) ? route('consultations.update', $consultation) : route('consultations.store') }}" method="POST" class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8">
        @csrf
        @if(isset($consultation))
            @method('PUT')
        @endif

        <div class="space-y-8">
            <!-- People & Date -->
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
                                <option value="{{ $patient->id }}" {{ isset($consultation) && $consultation->patient_id === $patient->id ? 'selected' : '' }}>{{ $patient->user->name ?? 'N/A' }}</option>
                            @endforeach
                        </select>
                        @error('patient_id')<p class="text-rose-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="doctor_id" class="block text-sm font-semibold text-slate-700 mb-2">Doctor</label>
                        <select name="doctor_id" id="doctor_id" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all bg-white" required>
                            <option value="">Select Doctor</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}" {{ isset($consultation) && $consultation->doctor_id === $doctor->id ? 'selected' : '' }}>{{ $doctor->user->name ?? 'N/A' }}</option>
                            @endforeach
                        </select>
                        @error('doctor_id')<p class="text-rose-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="consultation_date" class="block text-sm font-semibold text-slate-700 mb-2">Date</label>
                        <input type="date" name="consultation_date" id="consultation_date"
                            value="{{ isset($consultation) ? $consultation->consultation_date : old('consultation_date') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all" required>
                    </div>
                    <div>
                        <label for="consultation_time" class="block text-sm font-semibold text-slate-700 mb-2">Time</label>
                        <input type="time" name="consultation_time" id="consultation_time"
                            value="{{ isset($consultation) ? $consultation->consultation_time : old('consultation_time') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all" required>
                    </div>
                    <div>
                        <label for="consultation_type" class="block text-sm font-semibold text-slate-700 mb-2">Type</label>
                        <select name="consultation_type" id="consultation_type" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all bg-white" required>
                            <option value="in-person" {{ isset($consultation) && $consultation->consultation_type === 'in-person' ? 'selected' : '' }}>In-Person</option>
                            <option value="telehealth" {{ isset($consultation) && $consultation->consultation_type === 'telehealth' ? 'selected' : '' }}>Telehealth</option>
                            <option value="video-call" {{ isset($consultation) && $consultation->consultation_type === 'video-call' ? 'selected' : '' }}>Video Call</option>
                            <option value="phone" {{ isset($consultation) && $consultation->consultation_type === 'phone' ? 'selected' : '' }}>Phone</option>
                        </select>
                    </div>
                    <div>
                        <label for="diagnosis" class="block text-sm font-semibold text-slate-700 mb-2">Diagnosis</label>
                        <input type="text" name="diagnosis" id="diagnosis"
                            value="{{ isset($consultation) ? $consultation->diagnosis : old('diagnosis') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all">
                        @error('diagnosis')<p class="text-rose-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            <!-- Symptoms & Plan -->
            <div>
                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-4 flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-violet-50 flex items-center justify-center"><i class="fas fa-clipboard-list text-violet-600 text-xs"></i></div>
                    Details
                </h3>
                <div class="space-y-5">
                    <div>
                        <label for="symptoms" class="block text-sm font-semibold text-slate-700 mb-2">Symptoms</label>
                        <textarea name="symptoms" id="symptoms" rows="3"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all resize-y"
                            placeholder="Comma-separated list">{{ isset($consultation) ? implode(', ', $consultation->symptoms ?? []) : old('symptoms') }}</textarea>
                    </div>
                    <div>
                        <label for="treatment_plan" class="block text-sm font-semibold text-slate-700 mb-2">Treatment Plan</label>
                        <textarea name="treatment_plan" id="treatment_plan" rows="3"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all resize-y">{{ isset($consultation) ? $consultation->treatment_plan : old('treatment_plan') }}</textarea>
                    </div>
                    <div>
                        <label for="medications_prescribed" class="block text-sm font-semibold text-slate-700 mb-2">Medications Prescribed</label>
                        <textarea name="medications_prescribed" id="medications_prescribed" rows="2"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all resize-y"
                            placeholder="Comma-separated list">{{ isset($consultation) ? implode(', ', $consultation->medications_prescribed ?? []) : old('medications_prescribed') }}</textarea>
                    </div>
                    <div>
                        <label for="tests_recommended" class="block text-sm font-semibold text-slate-700 mb-2">Tests Recommended</label>
                        <textarea name="tests_recommended" id="tests_recommended" rows="2"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all resize-y"
                            placeholder="Comma-separated list">{{ isset($consultation) ? implode(', ', $consultation->tests_recommended ?? []) : old('tests_recommended') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Follow-up -->
            <div>
                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-4 flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-amber-50 flex items-center justify-center"><i class="fas fa-calendar-check text-amber-600 text-xs"></i></div>
                    Follow-up
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="flex items-center gap-3 p-4 rounded-xl bg-slate-50 border border-slate-100">
                        <input type="checkbox" name="follow_up_required" id="follow_up_required" value="1"
                            {{ isset($consultation) && $consultation->follow_up_required ? 'checked' : '' }}
                            class="w-5 h-5 rounded-lg border-slate-300 text-teal-600 focus:ring-teal-500/20">
                        <label for="follow_up_required" class="text-sm font-semibold text-slate-700">Follow-up Required</label>
                    </div>
                    <div>
                        <label for="follow_up_date" class="block text-sm font-semibold text-slate-700 mb-2">Follow-up Date</label>
                        <input type="date" name="follow_up_date" id="follow_up_date"
                            value="{{ isset($consultation) ? $consultation->follow_up_date : old('follow_up_date') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all">
                    </div>
                </div>
            </div>

            <!-- Notes -->
            <div>
                <label for="consultation_notes" class="block text-sm font-semibold text-slate-700 mb-2">Consultation Notes</label>
                <textarea name="consultation_notes" id="consultation_notes" rows="4"
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all resize-y">{{ isset($consultation) ? $consultation->consultation_notes : old('consultation_notes') }}</textarea>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-slate-100 flex items-center gap-3">
            <button type="submit" class="btn-primary px-6 py-2.5 rounded-xl text-sm font-semibold shadow-lg shadow-teal-500/25">
                {{ isset($consultation) ? 'Update Consultation' : 'Record Consultation' }}
            </button>
            <a href="{{ route('consultations.index') }}" class="px-6 py-2.5 rounded-xl bg-slate-100 text-slate-600 text-sm font-semibold hover:bg-slate-200 transition-colors">Cancel</a>
        </div>
    </form>
</div>
@endsection
