@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Welcome -->
<div class="editorial-card rounded-2xl p-8 mb-10 relative overflow-hidden" style="background:#00302f;">
    <div class="relative">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest mb-2" style="color:rgba(247,237,224,0.4);">Welcome back</p>
                <h1 class="font-bold text-cream-100 tracking-tight" style="font-size:28px; letter-spacing:-0.8px;">Dashboard Overview</h1>
            </div>
            <div class="flex items-center gap-3 rounded-xl px-5 py-3" style="background:rgba(247,237,224,0.08); border:1px solid rgba(247,237,224,0.1);">
                <i class="fas fa-calendar text-xs" style="color:#b2d1cc;"></i>
                <span class="text-sm font-semibold" style="color:#f7ede0;">{{ now()->format('F j, Y') }}</span>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5 mb-10">
    @php
        $stats = [
            ['label'=>'Patients','count'=>\App\Models\Patient::count(),'icon'=>'fa-users'],
            ['label'=>'Doctors','count'=>\App\Models\Doctor::count(),'icon'=>'fa-user-md'],
            ['label'=>'Appointments','count'=>\App\Models\Appointment::count(),'icon'=>'fa-calendar-check'],
            ['label'=>'Consultations','count'=>\App\Models\Consultation::count(),'icon'=>'fa-stethoscope'],
            ['label'=>'Records','count'=>\App\Models\MedicalRecord::count(),'icon'=>'fa-file-medical'],
        ];
    @endphp
    @foreach($stats as $stat)
        <div class="editorial-card rounded-2xl p-6 relative overflow-hidden reveal" style="background:white; animation-delay:{{ $loop->index * 0.05 }}s;">
            <div class="relative">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background:rgba(0,48,47,0.06);">
                        <i class="fas {{ $stat['icon'] }} text-xs" style="color:#00302f;"></i>
                    </div>
                    <span class="text-xs font-semibold uppercase tracking-widest" style="color:rgba(0,48,47,0.4);">{{ $stat['label'] }}</span>
                </div>
                <p class="font-bold" style="font-size:32px; letter-spacing:-1px; color:#00302f;">{{ $stat['count'] }}</p>
            </div>
        </div>
    @endforeach
</div>

<!-- Main Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">
    <!-- Activity Chart -->
    <div class="lg:col-span-2 editorial-card rounded-2xl p-6" style="background:white;">
        <div class="flex items-center justify-between mb-8">
            <h3 class="font-bold" style="font-size:18px; color:#00302f;">Activity Overview</h3>
            <div class="flex items-center gap-4 text-xs font-medium" style="color:rgba(0,48,47,0.4);">
                <span class="flex items-center gap-2"><span class="w-2 h-2 rounded-full" style="background:#00302f;"></span> Appointments</span>
                <span class="flex items-center gap-2"><span class="w-2 h-2 rounded-full" style="background:#b2d1cc;"></span> Consultations</span>
            </div>
        </div>
        <div class="h-56 flex items-end justify-around gap-5 px-2">
            @php
                $months = ['Jan','Feb','Mar','Apr','May','Jun'];
                $aptData = [12, 19, 8, 25, 15, 22];
                $conData = [8, 14, 11, 18, 20, 16];
            @endphp
            @foreach($months as $i => $month)
                <div class="flex flex-col items-center gap-3 flex-1">
                    <div class="w-full flex items-end justify-center gap-2 h-44">
                        <div class="w-full max-w-[18px] rounded-t-lg transition-all" style="background:#00302f; height: {{ $aptData[$i] * 5.5 }}%; opacity:0.85;"></div>
                        <div class="w-full max-w-[18px] rounded-t-lg transition-all" style="background:#b2d1cc; height: {{ $conData[$i] * 5.5 }}%;"></div>
                    </div>
                    <span class="text-xs font-medium" style="color:rgba(0,48,47,0.35);">{{ $month }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="editorial-card rounded-2xl p-6" style="background:white;">
        <h3 class="font-bold mb-6" style="font-size:18px; color:#00302f;">Quick Actions</h3>
        <div class="space-y-3">
            <a href="{{ route('patients.create') }}" class="flex items-center gap-4 p-4 rounded-xl transition-all group" style="background:white; border:1.5px solid rgba(0,48,47,0.12);">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background:#00302f;">
                    <i class="fas fa-plus text-cream-100 text-xs"></i>
                </div>
                <div>
                    <p class="font-bold text-sm" style="color:#00302f;">Add Patient</p>
                    <p class="text-xs" style="color:rgba(0,48,47,0.4);">Register a new patient</p>
                </div>
                <i class="fas fa-chevron-right ml-auto text-xs" style="color:rgba(0,48,47,0.2);"></i>
            </a>
            <a href="{{ route('doctors.create') }}" class="flex items-center gap-4 p-4 rounded-xl transition-all group" style="background:white; border:1.5px solid rgba(0,48,47,0.12);">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background:#00302f;">
                    <i class="fas fa-plus text-cream-100 text-xs"></i>
                </div>
                <div>
                    <p class="font-bold text-sm" style="color:#00302f;">Add Doctor</p>
                    <p class="text-xs" style="color:rgba(0,48,47,0.4);">Onboard a new specialist</p>
                </div>
                <i class="fas fa-chevron-right ml-auto text-xs" style="color:rgba(0,48,47,0.2);"></i>
            </a>
            <a href="{{ route('appointments.create') }}" class="flex items-center gap-4 p-4 rounded-xl transition-all group" style="background:white; border:1.5px solid rgba(0,48,47,0.12);">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background:#00302f;">
                    <i class="fas fa-plus text-cream-100 text-xs"></i>
                </div>
                <div>
                    <p class="font-bold text-sm" style="color:#00302f;">Schedule</p>
                    <p class="text-xs" style="color:rgba(0,48,47,0.4);">Book an appointment</p>
                </div>
                <i class="fas fa-chevron-right ml-auto text-xs" style="color:rgba(0,48,47,0.2);"></i>
            </a>
            <a href="{{ route('consultations.create') }}" class="flex items-center gap-4 p-4 rounded-xl transition-all group" style="background:white; border:1.5px solid rgba(0,48,47,0.12);">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background:#00302f;">
                    <i class="fas fa-plus text-cream-100 text-xs"></i>
                </div>
                <div>
                    <p class="font-bold text-sm" style="color:#00302f;">Consultation</p>
                    <p class="text-xs" style="color:rgba(0,48,47,0.4);">Record a consultation</p>
                </div>
                <i class="fas fa-chevron-right ml-auto text-xs" style="color:rgba(0,48,47,0.2);"></i>
            </a>
        </div>
    </div>
</div>

<!-- Recent Appointments -->
<div class="editorial-card rounded-2xl overflow-hidden" style="background:white;">
    <div class="px-6 py-5 flex items-center justify-between" style="border-bottom:2px solid rgba(0,48,47,0.1);">
        <h3 class="font-bold" style="font-size:18px; color:#00302f;">Recent Appointments</h3>
        <a href="{{ route('appointments.index') }}" class="text-xs font-semibold uppercase tracking-widest" style="color:#00302f;">View All</a>
    </div>
    <div>
        @forelse(\App\Models\Appointment::latest()->with('patient.user','doctor.user')->take(6)->get() as $appointment)
            <div class="px-6 py-4 flex items-center gap-4 hover:bg-black/[0.02] transition-colors" style="border-bottom:1px solid rgba(0,48,47,0.08);">
                <div class="w-10 h-10 rounded-full flex items-center justify-center text-cream-100 font-bold text-xs flex-shrink-0" style="background:#00302f;">
                    {{ strtoupper(substr($appointment->patient->user->name ?? 'P', 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-bold text-sm truncate" style="color:#00302f;">{{ $appointment->patient->user->name ?? 'Patient' }}</p>
                    <p class="text-xs" style="color:rgba(0,48,47,0.4);">Dr. {{ $appointment->doctor->user->name ?? 'Doctor' }} &middot; {{ $appointment->appointment_date->format('M d') }} at {{ $appointment->appointment_time }}</p>
                </div>
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
                <span class="status-badge-ed" style="background:{{ $s['bg'] }}; color:{{ $s['text'] }}; border:1px solid {{ $s['border'] }};">
                    <span class="w-1.5 h-1.5 rounded-full" style="background:{{ $s['text'] }};"></span>
                    {{ ucfirst($appointment->status) }}
                </span>
                <a href="{{ route('appointments.show', $appointment) }}" class="w-9 h-9 rounded-lg flex items-center justify-center transition-colors hover:bg-black/5" style="background:rgba(0,48,47,0.04);">
                    <i class="fas fa-eye text-xs" style="color:rgba(0,48,47,0.4);"></i>
                </a>
            </div>
        @empty
            <div class="px-6 py-14 text-center">
                <div class="w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-4" style="background:rgba(0,48,47,0.06);">
                    <i class="fas fa-calendar text-xl" style="color:rgba(0,48,47,0.25);"></i>
                </div>
                <p class="font-medium" style="color:rgba(0,48,47,0.5);">No appointments yet</p>
                <a href="{{ route('appointments.create') }}" class="text-xs font-semibold uppercase tracking-widest mt-3 inline-block" style="color:#00302f;">Schedule one now</a>
            </div>
        @endforelse
    </div>
</div>
@endsection
