@extends('layouts.app')

@section('title', isset($patient) ? 'Edit Patient' : 'Create Patient')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <p class="text-slate-500 text-sm font-medium mb-1">{{ isset($patient) ? 'Update patient details' : 'Register a new patient' }}</p>
        <h1 class="text-3xl font-bold text-slate-800">{{ isset($patient) ? 'Edit Patient' : 'Add New Patient' }}</h1>
    </div>

    <form action="{{ isset($patient) ? route('patients.update', $patient) : route('patients.store') }}" method="POST" class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8">
        @csrf
        @if(isset($patient))
            @method('PUT')
        @endif

        <div class="space-y-8">
            <!-- Personal Info -->
            <div>
                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-4 flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center"><i class="fas fa-user text-blue-600 text-xs"></i></div>
                    Personal Information
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="date_of_birth" class="block text-sm font-semibold text-slate-700 mb-2">Date of Birth</label>
                        <input type="date" name="date_of_birth" id="date_of_birth"
                            value="{{ isset($patient) ? $patient->date_of_birth : old('date_of_birth') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all" required>
                        @error('date_of_birth')<p class="text-rose-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-semibold text-slate-700 mb-2">Phone</label>
                        <input type="text" name="phone" id="phone"
                            value="{{ isset($patient) ? $patient->phone : old('phone') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all" required>
                        @error('phone')<p class="text-rose-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="blood_type" class="block text-sm font-semibold text-slate-700 mb-2">Blood Type</label>
                        <select name="blood_type" id="blood_type" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all bg-white">
                            <option value="">Select Blood Type</option>
                            @foreach(['O+', 'O-', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'] as $type)
                                <option value="{{ $type }}" {{ isset($patient) && $patient->blood_type === $type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Address -->
            <div>
                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-4 flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center"><i class="fas fa-location-dot text-emerald-600 text-xs"></i></div>
                    Address
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="md:col-span-2">
                        <label for="address" class="block text-sm font-semibold text-slate-700 mb-2">Street Address</label>
                        <input type="text" name="address" id="address"
                            value="{{ isset($patient) ? $patient->address : old('address') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all" required>
                        @error('address')<p class="text-rose-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="city" class="block text-sm font-semibold text-slate-700 mb-2">City</label>
                        <input type="text" name="city" id="city"
                            value="{{ isset($patient) ? $patient->city : old('city') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all" required>
                    </div>
                    <div>
                        <label for="state" class="block text-sm font-semibold text-slate-700 mb-2">State</label>
                        <input type="text" name="state" id="state"
                            value="{{ isset($patient) ? $patient->state : old('state') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all" required>
                    </div>
                    <div>
                        <label for="postal_code" class="block text-sm font-semibold text-slate-700 mb-2">Postal Code</label>
                        <input type="text" name="postal_code" id="postal_code"
                            value="{{ isset($patient) ? $patient->postal_code : old('postal_code') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all" required>
                    </div>
                    <div>
                        <label for="country" class="block text-sm font-semibold text-slate-700 mb-2">Country</label>
                        <input type="text" name="country" id="country"
                            value="{{ isset($patient) ? $patient->country : old('country') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all" required>
                    </div>
                </div>
            </div>

            <!-- Emergency -->
            <div>
                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-4 flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-rose-50 flex items-center justify-center"><i class="fas fa-phone-volume text-rose-600 text-xs"></i></div>
                    Emergency Contact
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="emergency_contact" class="block text-sm font-semibold text-slate-700 mb-2">Contact Name</label>
                        <input type="text" name="emergency_contact" id="emergency_contact"
                            value="{{ isset($patient) ? $patient->emergency_contact : old('emergency_contact') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all" required>
                        @error('emergency_contact')<p class="text-rose-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="emergency_contact_phone" class="block text-sm font-semibold text-slate-700 mb-2">Contact Phone</label>
                        <input type="text" name="emergency_contact_phone" id="emergency_contact_phone"
                            value="{{ isset($patient) ? $patient->emergency_contact_phone : old('emergency_contact_phone') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all" required>
                        @error('emergency_contact_phone')<p class="text-rose-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            <!-- Insurance -->
            <div>
                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-4 flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-amber-50 flex items-center justify-center"><i class="fas fa-shield-heart text-amber-600 text-xs"></i></div>
                    Insurance
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="insurance_provider" class="block text-sm font-semibold text-slate-700 mb-2">Provider</label>
                        <input type="text" name="insurance_provider" id="insurance_provider"
                            value="{{ isset($patient) ? $patient->insurance_provider : old('insurance_provider') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all">
                    </div>
                    <div>
                        <label for="insurance_policy_number" class="block text-sm font-semibold text-slate-700 mb-2">Policy Number</label>
                        <input type="text" name="insurance_policy_number" id="insurance_policy_number"
                            value="{{ isset($patient) ? $patient->insurance_policy_number : old('insurance_policy_number') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all">
                    </div>
                </div>
            </div>

            <!-- Medical -->
            <div>
                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-4 flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-violet-50 flex items-center justify-center"><i class="fas fa-file-medical text-violet-600 text-xs"></i></div>
                    Medical Details
                </h3>
                <div class="space-y-5">
                    <div>
                        <label for="medical_history" class="block text-sm font-semibold text-slate-700 mb-2">Medical History</label>
                        <textarea name="medical_history" id="medical_history" rows="3"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all resize-y"
                            placeholder="Comma-separated list">{{ isset($patient) ? implode(', ', $patient->medical_history ?? []) : old('medical_history') }}</textarea>
                    </div>
                    <div>
                        <label for="allergies" class="block text-sm font-semibold text-slate-700 mb-2">Allergies</label>
                        <textarea name="allergies" id="allergies" rows="3"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all resize-y"
                            placeholder="Comma-separated list">{{ isset($patient) ? implode(', ', $patient->allergies ?? []) : old('allergies') }}</textarea>
                    </div>
                    <div>
                        <label for="current_medications" class="block text-sm font-semibold text-slate-700 mb-2">Current Medications</label>
                        <textarea name="current_medications" id="current_medications" rows="3"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all resize-y"
                            placeholder="Comma-separated list">{{ isset($patient) ? implode(', ', $patient->current_medications ?? []) : old('current_medications') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-slate-100 flex items-center gap-3">
            <button type="submit" class="btn-primary px-6 py-2.5 rounded-xl text-sm font-semibold shadow-lg shadow-teal-500/25">
                {{ isset($patient) ? 'Update Patient' : 'Add Patient' }}
            </button>
            <a href="{{ route('patients.index') }}" class="px-6 py-2.5 rounded-xl bg-slate-100 text-slate-600 text-sm font-semibold hover:bg-slate-200 transition-colors">Cancel</a>
        </div>
    </form>
</div>
@endsection
