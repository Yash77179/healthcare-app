@extends('layouts.app')

@section('title', isset($doctor) ? 'Edit Doctor' : 'Create Doctor')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <p class="text-slate-500 text-sm font-medium mb-1">{{ isset($doctor) ? 'Update doctor information' : 'Onboard a new specialist' }}</p>
        <h1 class="text-3xl font-bold text-slate-800">{{ isset($doctor) ? 'Edit Doctor' : 'Add New Doctor' }}</h1>
    </div>

    <form action="{{ isset($doctor) ? route('doctors.update', $doctor) : route('doctors.store') }}" method="POST" class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8">
        @csrf
        @if(isset($doctor))
            @method('PUT')
        @endif

        <div class="space-y-8">
            <!-- Professional Info -->
            <div>
                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-4 flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center">
                        <i class="fas fa-user-doctor text-emerald-600 text-xs"></i>
                    </div>
                    Professional Information
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="specialization" class="block text-sm font-semibold text-slate-700 mb-2">Specialization</label>
                        <input type="text" name="specialization" id="specialization"
                            value="{{ isset($doctor) ? $doctor->specialization : old('specialization') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all" required>
                        @error('specialization')<p class="text-rose-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="license_number" class="block text-sm font-semibold text-slate-700 mb-2">License Number</label>
                        <input type="text" name="license_number" id="license_number"
                            value="{{ isset($doctor) ? $doctor->license_number : old('license_number') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all" required>
                        @error('license_number')<p class="text-rose-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="years_of_experience" class="block text-sm font-semibold text-slate-700 mb-2">Years of Experience</label>
                        <input type="number" name="years_of_experience" id="years_of_experience"
                            value="{{ isset($doctor) ? $doctor->years_of_experience : old('years_of_experience') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all">
                    </div>
                    <div>
                        <label for="consultation_fee" class="block text-sm font-semibold text-slate-700 mb-2">Consultation Fee ($)</label>
                        <input type="number" name="consultation_fee" id="consultation_fee" step="0.01"
                            value="{{ isset($doctor) ? $doctor->consultation_fee : old('consultation_fee') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all">
                    </div>
                </div>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-4 flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center">
                        <i class="fas fa-address-book text-blue-600 text-xs"></i>
                    </div>
                    Contact & Location
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="phone" class="block text-sm font-semibold text-slate-700 mb-2">Phone</label>
                        <input type="text" name="phone" id="phone"
                            value="{{ isset($doctor) ? $doctor->phone : old('phone') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all" required>
                    </div>
                    <div>
                        <label for="office_address" class="block text-sm font-semibold text-slate-700 mb-2">Office Address</label>
                        <input type="text" name="office_address" id="office_address"
                            value="{{ isset($doctor) ? $doctor->office_address : old('office_address') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all" required>
                    </div>
                    <div>
                        <label for="office_city" class="block text-sm font-semibold text-slate-700 mb-2">City</label>
                        <input type="text" name="office_city" id="office_city"
                            value="{{ isset($doctor) ? $doctor->office_city : old('office_city') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all" required>
                    </div>
                    <div>
                        <label for="office_state" class="block text-sm font-semibold text-slate-700 mb-2">State</label>
                        <input type="text" name="office_state" id="office_state"
                            value="{{ isset($doctor) ? $doctor->office_state : old('office_state') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all" required>
                    </div>
                    <div>
                        <label for="office_postal_code" class="block text-sm font-semibold text-slate-700 mb-2">Postal Code</label>
                        <input type="text" name="office_postal_code" id="office_postal_code"
                            value="{{ isset($doctor) ? $doctor->office_postal_code : old('office_postal_code') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all" required>
                    </div>
                    <div>
                        <label for="office_country" class="block text-sm font-semibold text-slate-700 mb-2">Country</label>
                        <input type="text" name="office_country" id="office_country"
                            value="{{ isset($doctor) ? $doctor->office_country : old('office_country') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all" required>
                    </div>
                </div>
            </div>

            <!-- Availability -->
            <div>
                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-4 flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-amber-50 flex items-center justify-center">
                        <i class="fas fa-clock text-amber-600 text-xs"></i>
                    </div>
                    Availability
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="availability_start_time" class="block text-sm font-semibold text-slate-700 mb-2">Start Time</label>
                        <input type="time" name="availability_start_time" id="availability_start_time"
                            value="{{ isset($doctor) ? $doctor->availability_start_time : old('availability_start_time') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all">
                    </div>
                    <div>
                        <label for="availability_end_time" class="block text-sm font-semibold text-slate-700 mb-2">End Time</label>
                        <input type="time" name="availability_end_time" id="availability_end_time"
                            value="{{ isset($doctor) ? $doctor->availability_end_time : old('availability_end_time') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all">
                    </div>
                    <div class="md:col-span-2">
                        <label for="available_days" class="block text-sm font-semibold text-slate-700 mb-2">Available Days</label>
                        <textarea name="available_days" id="available_days" rows="2"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all"
                            placeholder="Comma-separated list, e.g. Mon, Tue, Wed">{{ isset($doctor) ? implode(', ', $doctor->available_days ?? []) : old('available_days') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Bio & Qualifications -->
            <div>
                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-4 flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-violet-50 flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-violet-600 text-xs"></i>
                    </div>
                    Bio & Qualifications
                </h3>
                <div class="space-y-5">
                    <div>
                        <label for="bio" class="block text-sm font-semibold text-slate-700 mb-2">Professional Bio</label>
                        <textarea name="bio" id="bio" rows="4"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all resize-y">{{ isset($doctor) ? $doctor->bio : old('bio') }}</textarea>
                    </div>
                    <div>
                        <label for="qualifications" class="block text-sm font-semibold text-slate-700 mb-2">Qualifications</label>
                        <textarea name="qualifications" id="qualifications" rows="3"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all resize-y"
                            placeholder="Comma-separated list">{{ isset($doctor) ? implode(', ', $doctor->qualifications ?? []) : old('qualifications') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-slate-100 flex items-center gap-3">
            <button type="submit" class="btn-primary px-6 py-2.5 rounded-xl text-sm font-semibold shadow-lg shadow-teal-500/25">
                {{ isset($doctor) ? 'Update Doctor' : 'Add Doctor' }}
            </button>
            <a href="{{ route('doctors.index') }}" class="px-6 py-2.5 rounded-xl bg-slate-100 text-slate-600 text-sm font-semibold hover:bg-slate-200 transition-colors">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
