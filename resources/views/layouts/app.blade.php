<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Medica</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Manrope', 'Helvetica', 'Arial', 'sans-serif'],
                    },
                    colors: {
                        teal: {
                            DEFAULT: '#00302f',
                            50: '#e6f0ef',
                            100: '#b2d1cc',
                            800: '#00302f',
                            900: '#001a1a',
                        },
                        cream: {
                            DEFAULT: '#f7ede0',
                            50: '#fdf9f3',
                            100: '#f7ede0',
                            200: '#efe0cf',
                        },
                        sage: {
                            DEFAULT: '#b2d1cc',
                            100: '#b2d1cc',
                            200: '#8fb8b1',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        * { font-family: 'Manrope', Helvetica, Arial, sans-serif; box-sizing: border-box; -webkit-font-smoothing: antialiased; }
        
        ::-webkit-scrollbar { width: 4px; height: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #b2d1cc; border-radius: 4px; }
        
        /* Hexagonal frame for photos */
        .hex-frame {
            position: relative;
            width: 160px; height: 180px;
            margin: 0 auto;
        }
        .hex-frame .hex-inner {
            width: 100%; height: 100%;
            background: #00302f;
            clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
            padding: 4px;
        }
        .hex-frame .hex-inner img,
        .hex-frame .hex-inner .hex-avatar {
            width: 100%; height: 100%;
            object-fit: cover;
            clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
            background: #b2d1cc;
            display: flex; align-items: center; justify-content: center;
            color: #00302f; font-size: 48px; font-weight: 700;
        }
        
        .hex-frame-sm {
            width: 100px; height: 112px;
        }
        
        /* Editorial card - stronger borders and shadow */
        .editorial-card {
            background: white;
            border: 1px solid rgba(0,48,47,0.15);
            box-shadow: 0 1px 3px rgba(0,48,47,0.04), 0 4px 12px rgba(0,48,47,0.06);
            transition: all 0.5s ease;
        }
        .editorial-card:hover {
            border-color: rgba(0,48,47,0.25);
            box-shadow: 0 2px 8px rgba(0,48,47,0.06), 0 12px 28px rgba(0,48,47,0.1);
            transform: translateY(-4px);
        }
        
        /* Pill button */
        .pill-btn {
            display: inline-flex; align-items: center; justify-content: center;
            padding: 10px 28px; border-radius: 9999px;
            font-size: 13px; font-weight: 600; letter-spacing: 0.3px;
            transition: all 0.4s ease;
        }
        .pill-btn-teal {
            background: #00302f; color: #f7ede0;
        }
        .pill-btn-teal:hover {
            background: #001a1a; transform: translateY(-2px);
        }
        .pill-btn-cream {
            background: #f7ede0; color: #00302f; border: 1px solid rgba(0,48,47,0.12);
        }
        .pill-btn-cream:hover {
            background: #efe0cf;
        }
        .pill-btn-outline {
            background: transparent; color: #00302f;
            border: 1.5px solid #00302f;
        }
        .pill-btn-outline:hover {
            background: #00302f; color: #f7ede0;
        }
        
        /* Nav link editorial */
        .nav-link-ed {
            color: rgba(247,237,224,0.6);
            font-size: 13px; font-weight: 500;
            letter-spacing: 0.5px; text-transform: uppercase;
            transition: color 0.4s ease;
            padding: 8px 0;
            position: relative;
        }
        .nav-link-ed:hover { color: #f7ede0; }
        .nav-link-ed.active { color: #f7ede0; }
        .nav-link-ed.active::after {
            content: ''; position: absolute; bottom: 0; left: 0; right: 0;
            height: 1.5px; background: #b2d1cc;
        }
        
        /* Admin nav */
        .admin-nav-link {
            display: flex; align-items: center; gap: 14px;
            padding: 14px 18px; border-radius: 12px;
            color: rgba(247,237,224,0.5); font-weight: 500; font-size: 14px;
            transition: all 0.3s ease;
            border-left: 2px solid transparent;
        }
        .admin-nav-link:hover { color: #f7ede0; background: rgba(247,237,224,0.04); }
        .admin-nav-link.active {
            color: #00302f; background: #f7ede0;
            border-left-color: #b2d1cc;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }
        
        /* Section divider line */
        .section-line {
            width: 48px; height: 2px; background: #00302f;
        }
        
        /* Tag pill - stronger border */
        .tag-pill {
            display: inline-flex; align-items: center;
            padding: 6px 16px; border-radius: 9999px;
            font-size: 12px; font-weight: 600; letter-spacing: 0.4px;
            border: 1.5px solid rgba(0,48,47,0.2);
            color: #00302f; background: rgba(178,209,204,0.25);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.5);
        }
        
        /* Status badge - stronger borders */
        .status-badge-ed {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 6px 14px; border-radius: 9999px;
            font-size: 12px; font-weight: 600; letter-spacing: 0.3px;
            border: 1.5px solid;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.3);
        }
        
        /* Table editorial - stronger borders */
        .table-ed th {
            padding: 18px 24px; font-size: 11px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 1px;
            color: rgba(0,48,47,0.55);
            border-bottom: 2px solid rgba(0,48,47,0.12);
            background: rgba(0,48,47,0.02);
        }
        .table-ed td {
            padding: 20px 24px;
            border-bottom: 1px solid rgba(0,48,47,0.1);
            color: #00302f; font-size: 14px;
        }
        .table-ed tr:hover td { background: rgba(178,209,204,0.08); }
        
        /* Input editorial */
        .input-ed {
            width: 100%; padding: 14px 20px;
            border: 1.5px solid rgba(0,48,47,0.12); border-radius: 12px;
            background: white; font-size: 14px; color: #00302f;
            transition: all 0.3s ease;
        }
        .input-ed:focus {
            outline: none; border-color: #00302f;
            box-shadow: 0 0 0 3px rgba(0,48,47,0.06);
        }
        
        @keyframes fadeUp { from { opacity:0; transform: translateY(20px);} to { opacity:1; transform: translateY(0);} }
        .reveal { animation: fadeUp 0.6s ease-out forwards; }
        
        @keyframes lineGrow { from { width:0;} to { width:48px;} }
        .line-anim { animation: lineGrow 0.8s ease-out 0.3s forwards; width: 0; }
    </style>
</head>
<body class="bg-cream-100 text-teal-800" style="font-size:15px; line-height:1.5;">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-72 fixed h-full z-40 hidden lg:flex flex-col" style="background:#00302f;">
            <div class="p-8 pb-6">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background:#b2d1cc;">
                        <i class="fas fa-heart-pulse text-teal-800 text-sm"></i>
                    </div>
                    <div>
                        <span class="text-cream-100 font-bold text-lg tracking-tight block" style="letter-spacing:-0.3px;">Medica</span>
                        <span class="text-xs font-medium" style="color:rgba(247,237,224,0.4);">Healthcare</span>
                    </div>
                </a>
            </div>
            
            <nav class="flex-1 px-5 space-y-0.5 overflow-y-auto py-2">
                <a href="{{ route('dashboard') }}" class="admin-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-grid-2 w-4 text-center text-xs"></i> Dashboard
                </a>
                <a href="{{ route('doctors.index') }}" class="admin-nav-link {{ request()->routeIs('doctors.*') ? 'active' : '' }}">
                    <i class="fas fa-user-md w-4 text-center text-xs"></i> Doctors
                </a>
                <a href="{{ route('patients.index') }}" class="admin-nav-link {{ request()->routeIs('patients.*') ? 'active' : '' }}">
                    <i class="fas fa-users w-4 text-center text-xs"></i> Patients
                </a>
                <a href="{{ route('appointments.index') }}" class="admin-nav-link {{ request()->routeIs('appointments.*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-check w-4 text-center text-xs"></i> Appointments
                </a>
                <a href="{{ route('consultations.index') }}" class="admin-nav-link {{ request()->routeIs('consultations.*') ? 'active' : '' }}">
                    <i class="fas fa-stethoscope w-4 text-center text-xs"></i> Consultations
                </a>
                <a href="{{ route('medical-records.index') }}" class="admin-nav-link {{ request()->routeIs('medical-records.*') ? 'active' : '' }}">
                    <i class="fas fa-file-medical w-4 text-center text-xs"></i> Records
                </a>
            </nav>
            
            <div class="p-5 m-5 mb-8 rounded-2xl" style="background:rgba(178,209,204,0.1); border:1px solid rgba(178,209,204,0.15);">
                <p class="text-xs mb-4 leading-relaxed" style="color:rgba(247,237,224,0.5);">Need to add a new doctor?</p>
                <a href="{{ route('doctors.create') }}" class="pill-btn pill-btn-cream w-full flex items-center justify-center gap-2 text-xs py-2.5">
                    <i class="fas fa-plus text-xs"></i> Add Doctor
                </a>
            </div>
        </aside>

        <div class="flex-1 lg:ml-72">
            <header class="sticky top-0 z-30" style="background:rgba(247,237,224,0.85); backdrop-filter:blur(20px); -webkit-backdrop-filter:blur(20px); border-bottom:1px solid rgba(0,48,47,0.06);">
                <div class="flex items-center justify-between px-8 py-4">
                    <div class="flex items-center gap-4">
                        <button class="lg:hidden p-2.5 rounded-xl" style="background:rgba(0,48,47,0.06); color:#00302f;" onclick="document.querySelector('aside').classList.toggle('hidden');document.querySelector('aside').classList.toggle('flex')">
                            <i class="fas fa-bars"></i>
                        </button>
                        <div>
                            <h1 class="text-xl font-bold tracking-tight" style="color:#00302f; letter-spacing:-0.4px;">@yield('title')</h1>
                            <p class="text-xs mt-0.5" style="color:rgba(0,48,47,0.4);">Manage your healthcare operations</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="hidden md:flex items-center gap-3 px-5 py-2.5 rounded-full" style="background:white; border:1px solid rgba(0,48,47,0.08);">
                            <i class="fas fa-search text-xs" style="color:rgba(0,48,47,0.3);"></i>
                            <input type="text" placeholder="Search..." class="bg-transparent border-none outline-none text-sm w-32" style="color:#00302f;">
                        </div>
                        <button class="relative w-10 h-10 rounded-full flex items-center justify-center" style="background:white; border:1px solid rgba(0,48,47,0.08);">
                            <i class="fas fa-bell text-xs" style="color:rgba(0,48,47,0.4);"></i>
                            <span class="absolute top-0 right-0 w-2.5 h-2.5 rounded-full" style="background:#00302f;"></span>
                        </button>
                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-cream-100 font-bold text-sm" style="background:#00302f;">A</div>
                    </div>
                </div>
            </header>

            @if ($message = Session::get('success'))
                <div class="px-8 pt-6">
                    <div class="px-5 py-3.5 rounded-xl flex items-center gap-3 reveal max-w-2xl" style="background:rgba(178,209,204,0.2); border:1px solid rgba(0,48,47,0.1);">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0" style="background:rgba(0,48,47,0.08);">
                            <i class="fas fa-check text-xs" style="color:#00302f;"></i>
                        </div>
                        <span class="font-medium text-sm" style="color:#00302f;">{{ $message }}</span>
                        <button onclick="this.closest('.reveal').remove()" class="ml-auto w-6 h-6 rounded-full flex items-center justify-center transition-colors hover:bg-black/5">
                            <i class="fas fa-times text-xs" style="color:rgba(0,48,47,0.4);"></i>
                        </button>
                    </div>
                </div>
            @endif

            @if ($message = Session::get('error'))
                <div class="px-8 pt-6">
                    <div class="px-5 py-3.5 rounded-xl flex items-center gap-3 reveal max-w-2xl" style="background:rgba(0,48,47,0.04); border:1px solid rgba(0,48,47,0.1);">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0" style="background:rgba(0,48,47,0.08);">
                            <i class="fas fa-exclamation text-xs" style="color:#00302f;"></i>
                        </div>
                        <span class="font-medium text-sm" style="color:#00302f;">{{ $message }}</span>
                        <button onclick="this.closest('.reveal').remove()" class="ml-auto w-6 h-6 rounded-full flex items-center justify-center transition-colors hover:bg-black/5">
                            <i class="fas fa-times text-xs" style="color:rgba(0,48,47,0.4);"></i>
                        </button>
                    </div>
                </div>
            @endif

            <main class="px-8 py-8">
                @yield('content')
            </main>

            <footer class="px-8 py-8 text-center" style="border-top:1px solid rgba(0,48,47,0.06);">
                <p class="text-xs" style="color:rgba(0,48,47,0.35);">&copy; 2026 Medica Healthcare. All rights reserved.</p>
            </footer>
        </div>
    </div>
</body>
</html>
