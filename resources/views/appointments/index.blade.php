@extends('layouts.app')

@section('title', 'Appointments')

@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
    <div>
        <div class="section-line mb-4"></div>
        <p class="text-xs font-semibold uppercase tracking-widest mb-2" style="color:rgba(0,48,47,0.4);">Manage appointments</p>
        <h1 class="font-bold tracking-tight" style="font-size:32px; letter-spacing:-1px; color:#00302f;">Appointments</h1>
    </div>
    <a href="{{ route('appointments.create') }}" class="pill-btn pill-btn-teal self-start">
        <i class="fas fa-plus mr-2 text-xs"></i> Schedule
    </a>
</div>

<!-- Filters -->
<div class="flex gap-2 mb-8 overflow-x-auto pb-1">
    <button class="pill-btn" style="background:#00302f; color:#f7ede0;">All</button>
    <button class="pill-btn pill-btn-cream">Today</button>
    <button class="pill-btn pill-btn-cream">Upcoming</button>
    <button class="pill-btn pill-btn-cream">Completed</button>
    <button class="pill-btn pill-btn-cream">Cancelled</button>
</div>

<div class="space-y-3">
    @forelse($appointments as $appointment)
        @php
            $statusMap = [
                'confirmed'  => ['bg'=>'rgba(178,209,204,0.25)','text'=>'#00302f','border'=>'rgba(0,48,47,0.12)'],
                'scheduled'  => ['bg'=>'rgba(0,48,47,0.06)','text'=>'#00302f','border'=>'rgba(0,48,47,0.08)'],
                'completed'  => ['bg'=>'rgba(0,48,47,0.08)','text'=>'#00302f','border'=>'rgba(0,48,47,0.1)'],
                'cancelled'  => ['bg'=>'rgba(0,48,47,0.04)','text'=>'rgba(0,48,47,0.5)','border'=>'rgba(0,48,47,0.06)'],
                'no-show'    => ['bg'=>'rgba(0,48,47,0.04)','text'=>'rgba(0,48,47,0.4)','border'=>'rgba(0,48,47,0.06)'],
            ];
            $s = $statusMap[$appointment->status] ?? $statusMap['scheduled'];
        @endphp
        <div class="editorial-card rounded-2xl p-5 flex flex-col sm:flex-row sm:items-center gap-4" style="background:white;">
            <div class="flex items-center gap-4 flex-1 min-w-0">
                <div class="w-12 h-12 rounded-lg flex items-center justify-center text-cream-100 font-bold text-sm flex-shrink-0" style="background:#00302f;">
                    {{ strtoupper(substr($appointment->patient->user->name ?? 'P', 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <p class="font-bold text-sm truncate" style="color:#00302f;">{{ $appointment->patient->user->name ?? 'Patient' }}</p>
                    <p class="text-xs" style="color:rgba(0,48,47,0.4);">Dr. {{ $appointment->doctor->user->name ?? 'Doctor' }}</p>
                </div>
            </div>
            <div class="flex items-center gap-6 flex-shrink-0">
                <div class="flex items-center gap-2 text-sm" style="color:rgba(0,48,47,0.5);">
                    <i class="far fa-calendar text-xs" style="color:rgba(0,48,47,0.3);"></i>
                    {{ $appointment->appointment_date->format('M d, Y') }}
                </div>
                <div class="flex items-center gap-2 text-sm" style="color:rgba(0,48,47,0.5);">
                    <i class="far fa-clock text-xs" style="color:rgba(0,48,47,0.3);"></i>
                    {{ $appointment->appointment_time }}
                </div>
                <span class="status-badge-ed" style="background:{{ $s['bg'] }}; color:{{ $s['text'] }}; border:1px solid {{ $s['border'] }};">
                    <span class="w-1.5 h-1.5 rounded-full" style="background:{{ $s['text'] }};"></span>
                    {{ ucfirst($appointment->status) }}
                </span>
            </div>
            <div class="flex items-center gap-2 self-end sm:self-auto">
                <a href="{{ route('appointments.show', $appointment) }}" class="w-9 h-9 rounded-lg flex items-center justify-center transition-all border hover:border-teal-800" style="background:white; border:1.5px solid rgba(0,48,47,0.15);" title="View">
                    <i class="fas fa-eye text-xs" style="color:#00302f;"></i>
                </a>
                <a href="{{ route('appointments.edit', $appointment) }}" class="w-9 h-9 rounded-lg flex items-center justify-center transition-all border hover:border-teal-800" style="background:white; border:1.5px solid rgba(0,48,47,0.15);" title="Edit">
                    <i class="fas fa-edit text-xs" style="color:#00302f;"></i>
                </a>
                <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-9 h-9 rounded-lg flex items-center justify-center transition-all border hover:border-red-600" style="background:white; border:1.5px solid rgba(0,48,47,0.15);" title="Delete">
                        <i class="fas fa-trash text-xs" style="color:#00302f;"></i>
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="editorial-card rounded-2xl py-16 text-center" style="background:white;">
            <div class="w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-4 border-2" style="background:rgba(0,48,47,0.04); border-color:rgba(0,48,47,0.12);">
                <i class="fas fa-calendar text-xl" style="color:rgba(0,48,47,0.4);"></i>
            </div>
            <p class="font-medium" style="color:rgba(0,48,47,0.5);">No appointments found</p>
            <a href="{{ route('appointments.create') }}" class="text-xs font-semibold uppercase tracking-widest mt-3 inline-block" style="color:#00302f;">Schedule one now</a>
        </div>
    @endforelse
</div>

<div class="mt-8">
    {{ $appointments->links() }}
</div>
@endsection
