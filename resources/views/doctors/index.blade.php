@extends('layouts.app')

@section('title', 'Doctors')

@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
    <div>
        <div class="section-line mb-4"></div>
        <p class="text-xs font-semibold uppercase tracking-widest mb-2" style="color:rgba(0,48,47,0.4);">Find the best specialists</p>
        <h1 class="font-bold tracking-tight" style="font-size:32px; letter-spacing:-1px; color:#00302f;">Our Doctors</h1>
    </div>
    <a href="{{ route('doctors.create') }}" class="pill-btn pill-btn-teal self-start">
        <i class="fas fa-plus mr-2 text-xs"></i> Add Doctor
    </a>
</div>

<!-- Filter Bar -->
<div class="editorial-card rounded-2xl p-5 mb-8 flex flex-col sm:flex-row gap-3 items-center" style="background:white;">
    <div class="relative flex-1 w-full">
        <i class="fas fa-search absolute left-5 top-1/2 -translate-y-1/2 text-xs" style="color:rgba(0,48,47,0.3);"></i>
        <input type="text" placeholder="Search by name or specialization..." class="input-ed pl-12">
    </div>
    <div class="flex gap-2 overflow-x-auto w-full sm:w-auto pb-1 sm:pb-0">
        <button class="pill-btn" style="background:#00302f; color:#f7ede0;">All</button>
        <button class="pill-btn pill-btn-cream">Cardiology</button>
        <button class="pill-btn pill-btn-cream">Neurology</button>
        <button class="pill-btn pill-btn-cream">Pediatrics</button>
    </div>
</div>

<!-- Doctors Grid with Hexagonal Frames -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-10">
    @forelse($doctors as $doctor)
        <div class="text-center reveal" style="animation-delay:{{ $loop->index * 0.05 }}s;">
            <a href="{{ route('doctors.show', $doctor) }}">
                <div class="hex-frame mx-auto mb-6" style="width:140px; height:156px;">
                    <div class="hex-inner">
                        <div class="hex-avatar" style="font-size:48px;">
                            {{ strtoupper(substr($doctor->user->name ?? 'D', 0, 1)) }}
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ route('doctors.show', $doctor) }}">
                <p class="font-bold text-sm mb-1" style="letter-spacing:-0.2px; color:#00302f;">{{ $doctor->user->name ?? 'Doctor' }}</p>
            </a>
            <p class="text-xs mb-3" style="color:rgba(0,48,47,0.5);">{{ $doctor->specialization }}</p>
            <div class="flex items-center justify-center gap-1 mb-4">
                <div class="flex text-xs" style="color:#d4a017;">
                    @for($i=0; $i<5; $i++)
                        <i class="fas fa-star {{ $i < (rand(3,5)) ? '' : 'opacity-20' }}"></i>
                    @endfor
                </div>
                <span class="text-xs" style="color:rgba(0,48,47,0.35);">({{ rand(20, 150) }})</span>
            </div>
            <div class="flex items-center justify-center gap-3">
                <a href="{{ route('doctors.show', $doctor) }}" class="text-xs font-semibold uppercase tracking-widest" style="color:#00302f;">Profile</a>
                <span style="color:rgba(0,48,47,0.15);">|</span>
                <a href="{{ route('appointments.create', ['doctor_id' => $doctor->id]) }}" class="text-xs font-semibold uppercase tracking-widest" style="color:#00302f;">Book</a>
            </div>
        </div>
    @empty
        <div class="col-span-full py-20 text-center reveal">
            <div class="hex-frame mx-auto mb-6" style="width:100px; height:112px;">
                <div class="hex-inner">
                    <div class="hex-avatar" style="font-size:32px;"><i class="fas fa-user-md"></i></div>
                </div>
            </div>
            <h3 class="font-bold mb-2" style="color:#00302f;">No doctors yet</h3>
            <p class="text-sm mb-6" style="color:rgba(0,48,47,0.5);">Start by adding your first doctor to the platform.</p>
            <a href="{{ route('doctors.create') }}" class="pill-btn pill-btn-teal">
                <i class="fas fa-plus mr-2 text-xs"></i> Add Doctor
            </a>
        </div>
    @endforelse
</div>

<div class="mt-10">
    {{ $doctors->links() }}
</div>
@endsection
