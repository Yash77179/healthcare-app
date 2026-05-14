@extends('layouts.app')

@section('title', 'Consultations')

@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
    <div>
        <div class="section-line mb-4"></div>
        <p class="text-xs font-semibold uppercase tracking-widest mb-2" style="color:rgba(0,48,47,0.4);">Track consultations</p>
        <h1 class="font-bold tracking-tight" style="font-size:32px; letter-spacing:-1px; color:#00302f;">Consultations</h1>
    </div>
    <a href="{{ route('consultations.create') }}" class="pill-btn pill-btn-teal self-start">
        <i class="fas fa-plus mr-2 text-xs"></i> Record
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
    @forelse($consultations as $consultation)
        <div class="editorial-card rounded-2xl overflow-hidden" style="background:white;">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <span class="tag-pill">{{ ucfirst($consultation->consultation_type) }}</span>
                    <span class="text-xs" style="color:rgba(0,48,47,0.4);">{{ $consultation->consultation_date->format('M d, Y') }}</span>
                </div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center text-cream-100 font-bold text-sm" style="background:#00302f;">
                        {{ strtoupper(substr($consultation->patient->user->name ?? 'P', 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="font-bold text-sm truncate" style="color:#00302f;">{{ $consultation->patient->user->name ?? 'Patient' }}</p>
                        <p class="text-xs" style="color:rgba(0,48,47,0.4);">Dr. {{ $consultation->doctor->user->name ?? 'Doctor' }}</p>
                    </div>
                </div>
                <div class="mb-4">
                    <p class="text-xs uppercase tracking-wider font-semibold mb-1.5" style="color:rgba(0,48,47,0.4);">Diagnosis</p>
                    <p class="text-sm leading-relaxed" style="color:rgba(0,48,47,0.6);">{{ $consultation->diagnosis ? Str::limit($consultation->diagnosis, 80) : 'No diagnosis recorded' }}</p>
                </div>
                @if($consultation->medications_prescribed)
                    <div class="flex flex-wrap gap-1.5">
                        @foreach(array_slice((array)$consultation->medications_prescribed, 0, 3) as $med)
                            <span class="px-2 py-1 rounded-md text-xs font-medium" style="background:rgba(0,48,47,0.04); color:rgba(0,48,47,0.5);">{{ $med }}</span>
                        @endforeach
                        @if(count((array)$consultation->medications_prescribed) > 3)
                            <span class="px-2 py-1 rounded-md text-xs font-medium" style="background:rgba(0,48,47,0.04); color:rgba(0,48,47,0.5);">+{{ count((array)$consultation->medications_prescribed) - 3 }}</span>
                        @endif
                    </div>
                @endif
            </div>
            <div class="px-6 py-4 flex items-center gap-2" style="border-top:1.5px solid rgba(0,48,47,0.1); background:rgba(0,48,47,0.02);">
                <a href="{{ route('consultations.show', $consultation) }}" class="flex-1 py-2 rounded-lg text-xs font-semibold text-center transition-all border" style="background:white; border:1.5px solid rgba(0,48,47,0.15); color:#00302f;">View</a>
                <a href="{{ route('consultations.edit', $consultation) }}" class="flex-1 py-2 rounded-lg text-xs font-semibold text-center transition-all border" style="background:white; border:1.5px solid rgba(0,48,47,0.15); color:#00302f;">Edit</a>
                <form action="{{ route('consultations.destroy', $consultation) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-full py-2 rounded-lg text-xs font-semibold text-center transition-all border" style="background:white; border:1.5px solid rgba(0,48,47,0.15); color:#00302f;">Delete</button>
                </form>
            </div>
        </div>
    @empty
        <div class="col-span-full py-16 text-center">
            <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 border-2" style="background:rgba(0,48,47,0.04); border-color:rgba(0,48,47,0.12);">
                <i class="fas fa-stethoscope text-2xl" style="color:rgba(0,48,47,0.4);"></i>
            </div>
            <h3 class="text-lg font-semibold mb-1" style="color:#00302f;">No consultations yet</h3>
            <p class="text-sm mb-4" style="color:rgba(0,48,47,0.5);">Record your first consultation to get started.</p>
            <a href="{{ route('consultations.create') }}" class="pill-btn pill-btn-teal inline-flex">
                <i class="fas fa-plus mr-2 text-xs"></i> Record Consultation
            </a>
        </div>
    @endforelse
</div>

<div class="mt-8">
    {{ $consultations->links() }}
</div>
@endsection
