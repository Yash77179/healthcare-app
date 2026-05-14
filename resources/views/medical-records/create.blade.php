@extends('layouts.app')

@section('title', isset($record) ? 'Edit Medical Record' : 'Add Medical Record')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <p class="text-slate-500 text-sm font-medium mb-1">{{ isset($record) ? 'Update record' : 'Add a new medical record' }}</p>
        <h1 class="text-3xl font-bold text-slate-800">{{ isset($record) ? 'Edit Medical Record' : 'Add Medical Record' }}</h1>
    </div>

    <form action="{{ isset($record) ? route('medical-records.update', $record) : route('medical-records.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8">
        @csrf
        @if(isset($record))
            @method('PUT')
        @endif

        <div class="space-y-8">
            <!-- People & Type -->
            <div>
                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-4 flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center"><i class="fas fa-user text-blue-600 text-xs"></i></div>
                    Record Details
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="patient_id" class="block text-sm font-semibold text-slate-700 mb-2">Patient</label>
                        <select name="patient_id" id="patient_id" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all bg-white" required>
                            <option value="">Select Patient</option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}" {{ isset($record) && $record->patient_id === $patient->id ? 'selected' : '' }}>{{ $patient->user->name ?? 'N/A' }}</option>
                            @endforeach
                        </select>
                        @error('patient_id')<p class="text-rose-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="doctor_id" class="block text-sm font-semibold text-slate-700 mb-2">Doctor (Optional)</label>
                        <select name="doctor_id" id="doctor_id" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all bg-white">
                            <option value="">Select Doctor</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}" {{ isset($record) && $record->doctor_id === $doctor->id ? 'selected' : '' }}>{{ $doctor->user->name ?? 'N/A' }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="record_type" class="block text-sm font-semibold text-slate-700 mb-2">Record Type</label>
                        <input type="text" name="record_type" id="record_type"
                            value="{{ isset($record) ? $record->record_type : old('record_type') }}"
                            placeholder="e.g., Lab Result, X-Ray, Prescription"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all" required>
                        @error('record_type')<p class="text-rose-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="record_date" class="block text-sm font-semibold text-slate-700 mb-2">Record Date</label>
                        <input type="date" name="record_date" id="record_date"
                            value="{{ isset($record) ? $record->record_date : old('record_date') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all" required>
                        @error('record_date')<p class="text-rose-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="visibility" class="block text-sm font-semibold text-slate-700 mb-2">Visibility</label>
                        <select name="visibility" id="visibility" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all bg-white" required>
                            <option value="private" {{ isset($record) && $record->visibility === 'private' ? 'selected' : '' }}>Private</option>
                            <option value="shared_with_doctor" {{ isset($record) && $record->visibility === 'shared_with_doctor' ? 'selected' : '' }}>Shared with Doctor</option>
                            <option value="shared_with_patient" {{ isset($record) && $record->visibility === 'shared_with_patient' ? 'selected' : '' }}>Shared with Patient</option>
                            <option value="public" {{ isset($record) && $record->visibility === 'public' ? 'selected' : '' }}>Public</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- File Upload -->
            <div>
                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-4 flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-amber-50 flex items-center justify-center"><i class="fas fa-cloud-upload-alt text-amber-600 text-xs"></i></div>
                    File Attachment
                </h3>
                <div class="p-6 rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50/50 text-center">
                    <div class="w-12 h-12 rounded-xl bg-white border border-slate-200 flex items-center justify-center mx-auto mb-3 shadow-sm">
                        <i class="fas fa-paperclip text-slate-400 text-lg"></i>
                    </div>
                    <label for="file" class="cursor-pointer">
                        <span class="text-sm font-semibold text-teal-600 hover:text-teal-700">Click to upload</span>
                        <span class="text-sm text-slate-500"> or drag and drop</span>
                        <input type="file" name="file" id="file" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" class="hidden">
                    </label>
                    <p class="text-xs text-slate-400 mt-2">PDF, DOC, DOCX, JPG, JPEG, PNG (Max 10MB)</p>
                    @if(isset($record) && $record->file_path)
                        <p class="text-sm text-teal-600 mt-3 font-medium flex items-center justify-center gap-2">
                            <i class="fas fa-check-circle"></i> Current file: {{ $record->file_name }}
                        </p>
                    @endif
                    @error('file')<p class="text-rose-600 text-xs mt-2">{{ $message }}</p>@enderror
                </div>
            </div>

            <!-- Content -->
            <div>
                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-4 flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-violet-50 flex items-center justify-center"><i class="fas fa-align-left text-violet-600 text-xs"></i></div>
                    Content
                </h3>
                <div class="space-y-5">
                    <div>
                        <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Description</label>
                        <textarea name="description" id="description" rows="3"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all resize-y">{{ isset($record) ? $record->description : old('description') }}</textarea>
                    </div>
                    <div>
                        <label for="findings" class="block text-sm font-semibold text-slate-700 mb-2">Findings</label>
                        <textarea name="findings" id="findings" rows="3"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all resize-y"
                            placeholder="Comma-separated list">{{ isset($record) ? implode(', ', $record->findings ?? []) : old('findings') }}</textarea>
                    </div>
                    <div>
                        <label for="recommendations" class="block text-sm font-semibold text-slate-700 mb-2">Recommendations</label>
                        <textarea name="recommendations" id="recommendations" rows="3"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all resize-y"
                            placeholder="Comma-separated list">{{ isset($record) ? implode(', ', $record->recommendations ?? []) : old('recommendations') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-slate-100 flex items-center gap-3">
            <button type="submit" class="btn-primary px-6 py-2.5 rounded-xl text-sm font-semibold shadow-lg shadow-teal-500/25">
                {{ isset($record) ? 'Update Record' : 'Add Record' }}
            </button>
            <a href="{{ route('medical-records.index') }}" class="px-6 py-2.5 rounded-xl bg-slate-100 text-slate-600 text-sm font-semibold hover:bg-slate-200 transition-colors">Cancel</a>
        </div>
    </form>
</div>
@endsection
