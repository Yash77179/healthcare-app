@extends('layouts.app')

@section('title', 'Patients')

@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
    <div>
        <div class="section-line mb-4"></div>
        <p class="text-xs font-semibold uppercase tracking-widest mb-2" style="color:rgba(0,48,47,0.4);">Manage your patients</p>
        <h1 class="font-bold tracking-tight" style="font-size:32px; letter-spacing:-1px; color:#00302f;">Patients</h1>
    </div>
    <a href="{{ route('patients.create') }}" class="pill-btn pill-btn-teal self-start">
        <i class="fas fa-plus mr-2 text-xs"></i> Add Patient
    </a>
</div>

<div class="editorial-card rounded-2xl overflow-hidden" style="background:white;">
    <div class="overflow-x-auto">
        <table class="w-full table-ed">
            <thead>
                <tr>
                    <th class="text-left">Patient</th>
                    <th class="text-left">Contact</th>
                    <th class="text-left">Location</th>
                    <th class="text-left">Blood</th>
                    <th class="text-left">Insurance</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($patients as $patient)
                    <tr class="group">
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg flex items-center justify-center text-cream-100 font-bold text-sm" style="background:#00302f;">
                                    {{ strtoupper(substr($patient->user->name ?? 'P', 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-bold text-sm" style="color:#00302f;">{{ $patient->user->name ?? 'Patient' }}</p>
                                    <p class="text-xs" style="color:rgba(0,48,47,0.4);">{{ $patient->date_of_birth ? $patient->date_of_birth->age . ' years' : 'Age unknown' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="text-sm" style="color:rgba(0,48,47,0.5);">{{ $patient->phone }}</td>
                        <td class="text-sm" style="color:rgba(0,48,47,0.5);">{{ $patient->city }}</td>
                        <td>
                            <span class="tag-pill">{{ $patient->blood_type ?? 'Unknown' }}</span>
                        </td>
                        <td class="text-sm" style="color:rgba(0,48,47,0.5);">{{ $patient->insurance_provider ?? '—' }}</td>
                        <td class="text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('patients.show', $patient) }}" class="w-9 h-9 rounded-lg flex items-center justify-center transition-all border hover:border-teal-800" style="background:white; border:1.5px solid rgba(0,48,47,0.15);" title="View">
                                    <i class="fas fa-eye text-xs" style="color:#00302f;"></i>
                                </a>
                                <a href="{{ route('patients.edit', $patient) }}" class="w-9 h-9 rounded-lg flex items-center justify-center transition-all border hover:border-teal-800" style="background:white; border:1.5px solid rgba(0,48,47,0.15);" title="Edit">
                                    <i class="fas fa-edit text-xs" style="color:#00302f;"></i>
                                </a>
                                <form action="{{ route('patients.destroy', $patient) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-9 h-9 rounded-lg flex items-center justify-center transition-all border hover:border-red-600" style="background:white; border:1.5px solid rgba(0,48,47,0.15);" title="Delete">
                                        <i class="fas fa-trash text-xs" style="color:#00302f;"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-14 text-center">
                            <div class="w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-4 border-2" style="background:rgba(0,48,47,0.04); border-color:rgba(0,48,47,0.12);">
                                <i class="fas fa-users text-xl" style="color:rgba(0,48,47,0.4);"></i>
                            </div>
                            <p class="font-medium" style="color:rgba(0,48,47,0.5);">No patients found</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $patients->links() }}
</div>
@endsection
