<!-- Public landing page uses its own full-width layout (no sidebar) -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medica Healthcare</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { font-family: 'Manrope', Helvetica, Arial, sans-serif; box-sizing: border-box; -webkit-font-smoothing: antialiased; }
        .hex-frame { position: relative; width: 180px; height: 200px; margin: 0 auto; }
        .hex-frame .hex-inner { width: 100%; height: 100%; background: #00302f; clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%); padding: 4px; }
        .hex-frame .hex-inner .hex-avatar { width: 100%; height: 100%; clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%); background: #b2d1cc; display: flex; align-items: center; justify-content: center; color: #00302f; font-size: 56px; font-weight: 700; }
        .pill-btn { display: inline-flex; align-items: center; justify-content: center; padding: 12px 32px; border-radius: 9999px; font-size: 13px; font-weight: 600; letter-spacing: 0.3px; transition: all 0.4s ease; }
        .pill-btn-teal { background: #00302f; color: #f7ede0; }
        .pill-btn-teal:hover { background: #001a1a; transform: translateY(-2px); }
        .pill-btn-cream { background: #f7ede0; color: #00302f; border: 1.5px solid rgba(0,48,47,0.15); }
        .pill-btn-cream:hover { background: #efe0cf; }
        .section-line { width: 48px; height: 2px; background: #00302f; }
        .line-anim { animation: lineGrow 0.8s ease-out 0.3s forwards; width: 0; }
        @keyframes lineGrow { from { width:0;} to { width:48px;} }
        @keyframes fadeUp { from { opacity:0; transform: translateY(30px);} to { opacity:1; transform: translateY(0);} }
        .reveal { animation: fadeUp 0.8s ease-out forwards; }
    </style>
</head>
<body class="bg-cream-100" style="font-size:15px; line-height:1.6; color:#00302f;">

    <!-- Public Nav -->
    <nav class="fixed top-0 left-0 right-0 z-50" style="background:rgba(247,237,224,0.92); backdrop-filter:blur(20px); border-bottom:1px solid rgba(0,48,47,0.06);">
        <div class="max-w-7xl mx-auto px-8 py-5 flex items-center justify-between">
            <a href="/" class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg flex items-center justify-center" style="background:#00302f;">
                    <i class="fas fa-heart-pulse text-cream-100 text-sm"></i>
                </div>
                <span class="font-bold text-lg tracking-tight" style="letter-spacing:-0.5px;">Medica</span>
            </a>
            <div class="hidden md:flex items-center gap-10">
                <a href="/" class="text-xs font-semibold uppercase tracking-widest" style="color:#00302f;">Home</a>
                <a href="{{ route('doctors.index') }}" class="text-xs font-semibold uppercase tracking-widest" style="color:rgba(0,48,47,0.5);">Doctors</a>
                <a href="{{ route('patients.index') }}" class="text-xs font-semibold uppercase tracking-widest" style="color:rgba(0,48,47,0.5);">Patients</a>
                <a href="{{ route('appointments.index') }}" class="text-xs font-semibold uppercase tracking-widest" style="color:rgba(0,48,47,0.5);">Appointments</a>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}" class="pill-btn pill-btn-teal">Book Online</a>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="pt-32 pb-20 px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="reveal">
                    <div class="section-line line-anim mb-8"></div>
                    <h1 class="font-bold leading-[1.1] mb-8" style="font-size:52px; letter-spacing:-1.5px;">
                        Your Health,<br>Our Priority
                    </h1>
                    <p class="mb-10 leading-relaxed" style="font-size:17px; color:rgba(0,48,47,0.6); max-width:440px;">
                        A modern, intelligent platform to manage doctors, patients, appointments, and medical records — all in one beautifully designed system.
                    </p>
                    <div class="flex items-center gap-4">
                        <a href="{{ route('dashboard') }}" class="pill-btn pill-btn-teal">
                            <i class="fas fa-rocket mr-2 text-xs"></i> Launch Dashboard
                        </a>
                        <a href="{{ route('doctors.index') }}" class="pill-btn pill-btn-cream">
                            <i class="fas fa-user-md mr-2 text-xs"></i> Find a Doctor
                        </a>
                    </div>
                </div>
                <div class="reveal" style="animation-delay:0.2s;">
                    <div class="relative">
                        <div class="rounded-3xl overflow-hidden" style="background:#00302f; padding: 60px;">
                            <div class="grid grid-cols-3 gap-4">
                                <div class="text-center">
                                    <p class="font-bold text-cream-100" style="font-size:36px; letter-spacing:-1px;">{{ \App\Models\Patient::count() }}</p>
                                    <p class="text-xs mt-1" style="color:rgba(247,237,224,0.5);">Patients</p>
                                </div>
                                <div class="text-center" style="border-left:1px solid rgba(247,237,224,0.15); border-right:1px solid rgba(247,237,224,0.15);">
                                    <p class="font-bold text-cream-100" style="font-size:36px; letter-spacing:-1px;">{{ \App\Models\Doctor::count() }}</p>
                                    <p class="text-xs mt-1" style="color:rgba(247,237,224,0.5);">Doctors</p>
                                </div>
                                <div class="text-center">
                                    <p class="font-bold text-cream-100" style="font-size:36px; letter-spacing:-1px;">{{ \App\Models\Appointment::count() }}</p>
                                    <p class="text-xs mt-1" style="color:rgba(247,237,224,0.5);">Appointments</p>
                                </div>
                            </div>
                            <div class="mt-8 pt-8" style="border-top:1px solid rgba(247,237,224,0.1);">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-xs font-semibold uppercase tracking-widest" style="color:rgba(247,237,224,0.4);">Consultations</p>
                                        <p class="font-bold text-cream-100 mt-1" style="font-size:28px;">{{ \App\Models\Consultation::count() }}</p>
                                    </div>
                                    <div class="w-12 h-12 rounded-full flex items-center justify-center" style="background:rgba(178,209,204,0.2);">
                                        <i class="fas fa-stethoscope text-cream-100 text-sm"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services -->
    <section class="py-24 px-8" style="background:white;">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16 reveal">
                <div class="section-line mx-auto mb-6"></div>
                <h2 class="font-bold mb-4" style="font-size:36px; letter-spacing:-1px;">Our Services</h2>
                <p class="mx-auto" style="color:rgba(0,48,47,0.5); max-width:480px; font-size:15px;">Comprehensive healthcare management for modern clinics and hospitals.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <a href="{{ route('patients.index') }}" class="group p-8 reveal" style="border:1px solid rgba(0,48,47,0.08); background:#f7ede0; transition:all 0.5s ease;">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-6" style="background:#00302f;">
                        <i class="fas fa-users text-cream-100 text-sm"></i>
                    </div>
                    <h3 class="font-bold mb-3" style="font-size:18px;">Patients</h3>
                    <p class="text-sm leading-relaxed mb-6" style="color:rgba(0,48,47,0.5);">Register, manage, and track patient records, medical history, and profiles in one place.</p>
                    <span class="text-xs font-semibold uppercase tracking-widest group-hover:tracking-[0.25em] transition-all" style="color:#00302f;">Explore <i class="fas fa-arrow-right ml-1 text-[10px]"></i></span>
                </a>
                <a href="{{ route('doctors.index') }}" class="group p-8 reveal" style="border:1px solid rgba(0,48,47,0.08); background:#f7ede0; transition:all 0.5s ease; animation-delay:0.1s;">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-6" style="background:#00302f;">
                        <i class="fas fa-user-md text-cream-100 text-sm"></i>
                    </div>
                    <h3 class="font-bold mb-3" style="font-size:18px;">Doctors</h3>
                    <p class="text-sm leading-relaxed mb-6" style="color:rgba(0,48,47,0.5);">Manage doctor profiles, specializations, schedules, and availability with ease.</p>
                    <span class="text-xs font-semibold uppercase tracking-widest group-hover:tracking-[0.25em] transition-all" style="color:#00302f;">Explore <i class="fas fa-arrow-right ml-1 text-[10px]"></i></span>
                </a>
                <a href="{{ route('appointments.index') }}" class="group p-8 reveal" style="border:1px solid rgba(0,48,47,0.08); background:#f7ede0; transition:all 0.5s ease; animation-delay:0.2s;">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-6" style="background:#00302f;">
                        <i class="fas fa-calendar-check text-cream-100 text-sm"></i>
                    </div>
                    <h3 class="font-bold mb-3" style="font-size:18px;">Appointments</h3>
                    <p class="text-sm leading-relaxed mb-6" style="color:rgba(0,48,47,0.5);">Schedule, confirm, and track appointments with smart reminders and status tracking.</p>
                    <span class="text-xs font-semibold uppercase tracking-widest group-hover:tracking-[0.25em] transition-all" style="color:#00302f;">Explore <i class="fas fa-arrow-right ml-1 text-[10px]"></i></span>
                </a>
                <a href="{{ route('consultations.index') }}" class="group p-8 reveal" style="border:1px solid rgba(0,48,47,0.08); background:#f7ede0; transition:all 0.5s ease; animation-delay:0.3s;">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-6" style="background:#00302f;">
                        <i class="fas fa-stethoscope text-cream-100 text-sm"></i>
                    </div>
                    <h3 class="font-bold mb-3" style="font-size:18px;">Consultations</h3>
                    <p class="text-sm leading-relaxed mb-6" style="color:rgba(0,48,47,0.5);">Record diagnoses, prescriptions, treatment plans, and follow-up schedules.</p>
                    <span class="text-xs font-semibold uppercase tracking-widest group-hover:tracking-[0.25em] transition-all" style="color:#00302f;">Explore <i class="fas fa-arrow-right ml-1 text-[10px]"></i></span>
                </a>
                <a href="{{ route('medical-records.index') }}" class="group p-8 reveal" style="border:1px solid rgba(0,48,47,0.08); background:#f7ede0; transition:all 0.5s ease; animation-delay:0.4s;">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-6" style="background:#00302f;">
                        <i class="fas fa-file-medical text-cream-100 text-sm"></i>
                    </div>
                    <h3 class="font-bold mb-3" style="font-size:18px;">Medical Records</h3>
                    <p class="text-sm leading-relaxed mb-6" style="color:rgba(0,48,47,0.5);">Securely store and manage patient medical records, files, and documents.</p>
                    <span class="text-xs font-semibold uppercase tracking-widest group-hover:tracking-[0.25em] transition-all" style="color:#00302f;">Explore <i class="fas fa-arrow-right ml-1 text-[10px]"></i></span>
                </a>
                <a href="{{ route('dashboard') }}" class="group p-8 reveal" style="border:1px solid rgba(0,48,47,0.08); background:#f7ede0; transition:all 0.5s ease; animation-delay:0.5s;">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-6" style="background:#00302f;">
                        <i class="fas fa-chart-pie text-cream-100 text-sm"></i>
                    </div>
                    <h3 class="font-bold mb-3" style="font-size:18px;">Dashboard</h3>
                    <p class="text-sm leading-relaxed mb-6" style="color:rgba(0,48,47,0.5);">Get a real-time overview of your healthcare system with key metrics and insights.</p>
                    <span class="text-xs font-semibold uppercase tracking-widest group-hover:tracking-[0.25em] transition-all" style="color:#00302f;">Explore <i class="fas fa-arrow-right ml-1 text-[10px]"></i></span>
                </a>
            </div>
        </div>
    </section>

    <!-- Team Preview -->
    <section class="py-24 px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16 reveal">
                <div class="section-line mx-auto mb-6"></div>
                <h2 class="font-bold mb-4" style="font-size:36px; letter-spacing:-1px;">Meet Our Team</h2>
                <p class="mx-auto" style="color:rgba(0,48,47,0.5); max-width:480px; font-size:15px;">Experienced professionals dedicated to your care.</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-12 max-w-4xl mx-auto">
                @php $doctorsList = \App\Models\Doctor::with('user')->take(6)->get(); @endphp
                @forelse($doctorsList as $doc)
                    <div class="text-center reveal">
                        <div class="hex-frame mb-5">
                            <div class="hex-inner">
                                <div class="hex-avatar">{{ strtoupper(substr($doc->user->name ?? 'D', 0, 1)) }}</div>
                            </div>
                        </div>
                        <p class="font-bold text-sm" style="letter-spacing:-0.2px;">{{ $doc->user->name ?? 'Doctor' }}</p>
                        <p class="text-xs mt-1" style="color:rgba(0,48,47,0.5);">{{ $doc->specialization }}</p>
                    </div>
                @empty
                    @for($i=0; $i<3; $i++)
                        <div class="text-center reveal" style="animation-delay:{{ $i*0.1 }}s;">
                            <div class="hex-frame mb-5">
                                <div class="hex-inner">
                                    <div class="hex-avatar">{{ chr(65+$i) }}</div>
                                </div>
                            </div>
                            <p class="font-bold text-sm" style="letter-spacing:-0.2px;">Dr. Example {{ $i+1 }}</p>
                            <p class="text-xs mt-1" style="color:rgba(0,48,47,0.5);">General Practice</p>
                        </div>
                    @endfor
                @endforelse
            </div>
            <div class="text-center mt-12 reveal">
                <a href="{{ route('doctors.index') }}" class="pill-btn pill-btn-outline">View All Doctors</a>
            </div>
        </div>
    </section>

    <!-- Partners -->
    <section class="py-20 px-8" style="background:white;">
        <div class="max-w-5xl mx-auto text-center reveal">
            <p class="text-xs font-semibold uppercase tracking-widest mb-10" style="color:rgba(0,48,47,0.4);">Trusted Partners</p>
            <div class="flex flex-wrap items-center justify-center gap-12 opacity-40">
                <div class="flex items-center gap-2 text-lg font-bold" style="color:#00302f;"><i class="fas fa-hospital"></i> MediCare</div>
                <div class="flex items-center gap-2 text-lg font-bold" style="color:#00302f;"><i class="fas fa-clinic-medical"></i> HealthPlus</div>
                <div class="flex items-center gap-2 text-lg font-bold" style="color:#00302f;"><i class="fas fa-user-nurse"></i> CareFirst</div>
                <div class="flex items-center gap-2 text-lg font-bold" style="color:#00302f;"><i class="fas fa-heartbeat"></i> VitaLink</div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-24 px-8" style="background:#00302f;">
        <div class="max-w-3xl mx-auto text-center reveal">
            <h2 class="font-bold text-cream-100 mb-6" style="font-size:36px; letter-spacing:-1px;">Ready to Transform Healthcare?</h2>
            <p class="mb-10" style="color:rgba(247,237,224,0.6); font-size:16px; max-width:500px; margin:0 auto 40px;">Start managing your healthcare system with the most intuitive and powerful platform available.</p>
            <a href="{{ route('dashboard') }}" class="pill-btn" style="background:#f7ede0; color:#00302f;">
                <i class="fas fa-rocket mr-2 text-xs"></i> Launch Dashboard
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer style="background:#00302f; border-top:1px solid rgba(247,237,224,0.08);">
        <div class="max-w-7xl mx-auto px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-9 h-9 rounded-lg flex items-center justify-center" style="background:#b2d1cc;">
                            <i class="fas fa-heart-pulse text-teal-800 text-sm"></i>
                        </div>
                        <span class="font-bold text-lg text-cream-100 tracking-tight">Medica</span>
                    </div>
                    <p class="text-sm leading-relaxed" style="color:rgba(247,237,224,0.4);">Modern healthcare management for clinics and hospitals.</p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-widest text-cream-100 mb-5">Navigation</p>
                    <div class="space-y-3">
                        <a href="/" class="block text-sm" style="color:rgba(247,237,224,0.4);">Home</a>
                        <a href="{{ route('doctors.index') }}" class="block text-sm" style="color:rgba(247,237,224,0.4);">Doctors</a>
                        <a href="{{ route('patients.index') }}" class="block text-sm" style="color:rgba(247,237,224,0.4);">Patients</a>
                        <a href="{{ route('appointments.index') }}" class="block text-sm" style="color:rgba(247,237,224,0.4);">Appointments</a>
                    </div>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-widest text-cream-100 mb-5">System</p>
                    <div class="space-y-3">
                        <a href="{{ route('consultations.index') }}" class="block text-sm" style="color:rgba(247,237,224,0.4);">Consultations</a>
                        <a href="{{ route('medical-records.index') }}" class="block text-sm" style="color:rgba(247,237,224,0.4);">Records</a>
                        <a href="{{ route('dashboard') }}" class="block text-sm" style="color:rgba(247,237,224,0.4);">Dashboard</a>
                    </div>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-widest text-cream-100 mb-5">Contact</p>
                    <div class="space-y-3">
                        <p class="text-sm" style="color:rgba(247,237,224,0.4);">info@medica.health</p>
                        <p class="text-sm" style="color:rgba(247,237,224,0.4);">+1 (555) 000-0000</p>
                    </div>
                </div>
            </div>
            <div class="mt-16 pt-8 text-center" style="border-top:1px solid rgba(247,237,224,0.06);">
                <p class="text-xs" style="color:rgba(247,237,224,0.25);">&copy; 2026 Medica Healthcare. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>
