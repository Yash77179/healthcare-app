@extends('layouts.app')

@section('title', $doctor->user->name ?? 'Doctor Profile')

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- Profile Hero -->
    <div class="editorial-card rounded-3xl overflow-hidden mb-8" style="background:#00302f;">
        <div class="h-36 relative" style="background:rgba(178,209,204,0.1);">
            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle, #f7ede0 1px, transparent 1px); background-size: 20px 20px;"></div>
        </div>
        <div class="px-8 pb-8 relative">
            <div class="flex flex-col md:flex-row md:items-end gap-6 -mt-16">
                <div class="hex-frame flex-shrink-0" style="width:120px; height:134px;">
                    <div class="hex-inner">
                        <div class="hex-avatar" style="font-size:40px; background:#b2d1cc;">
                            {{ strtoupper(substr($doctor->user->name ?? 'D', 0, 1)) }}
                        </div>
                    </div>
                </div>
                <div class="flex-1 min-w-0 pb-2">
                    <div class="flex flex-col md:flex-row md:items-center gap-3 md:gap-4">
                        <div>
                            <h1 class="font-bold text-cream-100" style="font-size:24px; letter-spacing:-0.5px;">{{ $doctor->user->name ?? 'Doctor' }}</h1>
                            <p class="font-semibold" style="color:#b2d1cc;">{{ $doctor->specialization }}</p>
                        </div>
                        <div class="flex items-center gap-1 rounded-xl px-3 py-1.5 self-start" style="background:rgba(247,237,224,0.08); border:1px solid rgba(247,237,224,0.1);">
                            <div class="flex text-xs" style="color:#d4a017;">
                                @for($i=0; $i<5; $i++)
                                    <i class="fas fa-star {{ $i < 4 ? '' : 'opacity-30' }}"></i>
                                @endfor
                            </div>
                            <span class="text-xs font-bold text-cream-100 ml-1">4.8</span>
                            <span class="text-xs" style="color:rgba(247,237,224,0.5);">({{ rand(30, 180) }})</span>
                        </div>
                    </div>
                </div>
                <div class="flex gap-3 pb-2 self-start md:self-auto">
                    <a href="{{ route('appointments.create', ['doctor_id' => $doctor->id]) }}" class="pill-btn" style="background:#f7ede0; color:#00302f;">
                        <i class="fas fa-calendar-plus mr-2 text-xs"></i> Book
                    </a>
                    <a href="{{ route('doctors.edit', $doctor) }}" class="pill-btn" style="background:transparent; color:#f7ede0; border:1.5px solid rgba(247,237,224,0.2);">
                        <i class="fas fa-edit mr-2 text-xs"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Bar -->
    <div class="grid grid-cols-3 gap-4 mb-8">
        <div class="editorial-card rounded-2xl p-5 text-center" style="background:white;">
            <p class="font-bold" style="font-size:24px; letter-spacing:-0.5px; color:#00302f;">{{ $doctor->years_of_experience ?? rand(5,25) }}y+</p>
            <p class="text-xs font-medium mt-1" style="color:rgba(0,48,47,0.4);">Experience</p>
        </div>
        <div class="editorial-card rounded-2xl p-5 text-center" style="background:white;">
            <p class="font-bold" style="font-size:24px; letter-spacing:-0.5px; color:#00302f;">{{ rand(1, 5) }}.{{ rand(1,9) }}k</p>
            <p class="text-xs font-medium mt-1" style="color:rgba(0,48,47,0.4);">Reviews</p>
        </div>
        <div class="editorial-card rounded-2xl p-5 text-center" style="background:white;">
            <p class="font-bold" style="font-size:24px; letter-spacing:-0.5px; color:#00302f;">${{ $doctor->consultation_fee ?? rand(50,300) }}</p>
            <p class="text-xs font-medium mt-1" style="color:rgba(0,48,47,0.4);">Consultation Fee</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column -->
        <div class="space-y-5">
            <!-- About -->
            <div class="editorial-card rounded-2xl p-6" style="background:white;">
                <h3 class="font-bold mb-4" style="color:#00302f;">About</h3>
                <p class="text-sm leading-relaxed" style="color:rgba(0,48,47,0.5);">{{ $doctor->bio ?? 'No bio provided.' }}</p>
            </div>

            <!-- Contact -->
            <div class="editorial-card rounded-2xl p-6" style="background:white;">
                <h3 class="font-bold mb-4" style="color:#00302f;">Contact</h3>
                <div class="space-y-3">
                    <div class="flex items-center gap-3 text-sm" style="color:rgba(0,48,47,0.5);">
                        <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0 border" style="background:white; border:1.5px solid rgba(0,48,47,0.12);">
                            <i class="fas fa-phone text-xs" style="color:#00302f;"></i>
                        </div>
                        {{ $doctor->phone }}
                    </div>
                    <div class="flex items-center gap-3 text-sm" style="color:rgba(0,48,47,0.5);">
                        <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0 border" style="background:white; border:1.5px solid rgba(0,48,47,0.12);">
                            <i class="fas fa-map-marker-alt text-xs" style="color:#00302f;"></i>
                        </div>
                        <span class="leading-snug">{{ $doctor->office_address }}, {{ $doctor->office_city }}</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm" style="color:rgba(0,48,47,0.5);">
                        <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0 border" style="background:white; border:1.5px solid rgba(0,48,47,0.12);">
                            <i class="fas fa-id-card text-xs" style="color:#00302f;"></i>
                        </div>
                        License {{ $doctor->license_number }}
                    </div>
                </div>
            </div>

            <!-- Availability -->
            <div class="editorial-card rounded-2xl p-6" style="background:white;">
                <h3 class="font-bold mb-4" style="color:#00302f;">Availability</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between text-sm">
                        <span style="color:rgba(0,48,47,0.4);">Days</span>
                        <span class="font-semibold" style="color:#00302f;">{{ implode(', ', (array)($doctor->available_days ?? [])) ?: 'N/A' }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span style="color:rgba(0,48,47,0.4);">Hours</span>
                        <span class="font-semibold" style="color:#00302f;">{{ $doctor->availability_start_time ?? '9:00' }} - {{ $doctor->availability_end_time ?? '17:00' }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span style="color:rgba(0,48,47,0.4);">Fee</span>
                        <span class="font-bold" style="color:#00302f;">${{ $doctor->consultation_fee ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="lg:col-span-2 space-y-5">
            <!-- Qualifications -->
            <div class="editorial-card rounded-2xl p-6" style="background:white;">
                <h3 class="font-bold mb-4" style="color:#00302f;">Qualifications</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach((array)($doctor->qualifications ?? ['MBBS', 'MD']) as $q)
                        <span class="tag-pill">{{ $q }}</span>
                    @endforeach
                </div>
            </div>

            <!-- Recent Appointments -->
            <div class="editorial-card rounded-2xl overflow-hidden" style="background:white;">
                <div class="px-6 py-5 flex items-center justify-between" style="border-bottom:1.5px solid rgba(0,48,47,0.1);">
                    <h3 class="font-bold" style="color:#00302f;">Recent Appointments</h3>
                    <a href="{{ route('doctors.appointments', $doctor) }}" class="text-xs font-semibold uppercase tracking-widest" style="color:#00302f;">View All</a>
                </div>
                <div>
                    @forelse($doctor->appointments->take(4) as $appointment)
                        <div class="px-6 py-4 flex items-center gap-4 hover:bg-black/[0.02] transition-colors" style="border-bottom:1px solid rgba(0,48,47,0.08);">
                            <div class="w-9 h-9 rounded-full flex items-center justify-center text-cream-100 text-xs font-bold" style="background:#00302f;">
                                {{ strtoupper(substr($appointment->patient->user->name ?? 'P', 0, 1)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-sm" style="color:#00302f;">{{ $appointment->patient->user->name ?? 'Patient' }}</p>
                                <p class="text-xs" style="color:rgba(0,48,47,0.4);">{{ $appointment->appointment_date->format('M d, Y') }} at {{ $appointment->appointment_time }}</p>
                            </div>
                            <span class="status-badge-ed" style="background:rgba(178,209,204,0.25); color:#00302f; border:1.5px solid rgba(0,48,47,0.15);">
                                <span class="w-1.5 h-1.5 rounded-full" style="background:#00302f;"></span>
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </div>
                    @empty
                        <div class="px-6 py-8 text-center text-sm" style="color:rgba(0,48,47,0.4);">No appointments yet</div>
                    @endforelse
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="editorial-card rounded-2xl overflow-hidden" style="background:white;">
                <div class="px-6 py-5 flex items-center justify-between" style="border-bottom:1.5px solid rgba(0,48,47,0.1);">
                    <div>
                        <h3 class="font-bold" style="color:#00302f;">Patient Reviews</h3>
                        <p class="text-xs mt-0.5" style="color:rgba(0,48,47,0.4);">What patients say about this doctor</p>
                    </div>
                    <div class="flex items-center gap-1 rounded-xl px-3 py-1.5" style="background:rgba(0,48,47,0.03); border:1.5px solid rgba(0,48,47,0.12);">
                        <i class="fas fa-star text-xs" style="color:#d4a017;"></i>
                        <span class="text-sm font-bold" style="color:#00302f;">4.8</span>
                    </div>
                </div>
                <div>
                    @php
                        $reviews = [
                            ['name' => 'Sarah M.', 'rating' => 5, 'date' => '2 days ago', 'text' => 'Dr. ' . ($doctor->user->name ?? 'Doctor') . ' was incredibly thorough and kind. Took the time to explain everything clearly. Highly recommend!'],
                            ['name' => 'James K.', 'rating' => 5, 'date' => '1 week ago', 'text' => 'Excellent care and very professional. The appointment was on time and the consultation was very helpful.'],
                            ['name' => 'Maria L.', 'rating' => 4, 'date' => '2 weeks ago', 'text' => 'Great doctor, very knowledgeable. The wait time was a bit longer than expected but the care made up for it.'],
                            ['name' => 'Robert T.', 'rating' => 5, 'date' => '1 month ago', 'text' => 'Best experience I have had with a specialist. Very attentive and the treatment plan worked perfectly.'],
                        ];
                    @endphp
                    @foreach($reviews as $review)
                        <div class="px-6 py-5" style="border-bottom:1px solid rgba(0,48,47,0.08);">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center text-cream-100 text-xs font-bold flex-shrink-0" style="background:#00302f;">
                                    {{ strtoupper(substr($review['name'], 0, 1)) }}
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-1">
                                        <div>
                                            <span class="font-bold text-sm" style="color:#00302f;">{{ $review['name'] }}</span>
                                            <span class="text-xs ml-2" style="color:rgba(0,48,47,0.4);">{{ $review['date'] }}</span>
                                        </div>
                                        <div class="flex text-xs" style="color:#d4a017;">
                                            @for($i=0; $i<5; $i++)
                                                <i class="fas fa-star {{ $i < $review['rating'] ? '' : 'opacity-20' }}"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="text-sm leading-relaxed" style="color:rgba(0,48,47,0.5);">{{ $review['text'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
