<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Manage Console') — Portfolio Administration</title>

    <!-- Favicon & Touch Icon: Authentic New York Times Initial 'A' Monogram -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.svg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,600;1,400&family=JetBrains+Mono:wght@400;500;600&family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 20;
            vertical-align: middle;
        }
        /* Hide scrollbars on modern horizontal tabs */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FAF9F6] text-[#1C1917] antialiased min-h-screen flex flex-col font-sans">
    
    @php
        $unreadInquiries = \App\Models\ContactMessage::where('is_read', false)->count();
    @endphp

    <!-- Executive Admin Header Bar -->
    <header class="bg-[#181614] text-[#FAF9F6] border-b border-[#2C2825] sticky top-0 z-40 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                
                <!-- Left: Monogram Brand & Subdomain -->
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 group">
                        <div class="w-8 h-8 rounded-lg bg-stone-800 border border-stone-700 flex items-center justify-center text-stone-200 font-serif font-bold text-sm group-hover:border-stone-500 group-hover:bg-stone-700 transition">
                            M
                        </div>
                        <div class="flex flex-col">
                            <span class="font-serif font-bold tracking-tight text-sm text-stone-100 group-hover:text-white transition leading-tight">
                                Manage Console
                            </span>
                            <span class="text-[10px] font-mono text-stone-400">
                                manage.portfolio
                            </span>
                        </div>
                    </a>
                </div>

                <!-- Center: Primary Navigation (Desktop) -->
                <nav class="hidden lg:flex items-center gap-1 bg-[#1F1C19] p-1 rounded-xl border border-stone-800/80 text-xs font-mono">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="px-3 py-1.5 rounded-lg transition flex items-center gap-1.5 {{ request()->routeIs('admin.dashboard') ? 'bg-[#2E2A26] text-white shadow-xs font-semibold' : 'text-stone-300 hover:text-white hover:bg-stone-800/60' }}">
                        <span class="material-symbols-outlined text-[16px]">dashboard</span>
                        <span>Overview</span>
                    </a>

                    <span class="w-[1px] h-4 bg-stone-700 mx-1"></span>

                    <!-- Portfolio Content Group -->
                    <a href="{{ route('admin.profile.edit') }}" 
                       class="px-2.5 py-1.5 rounded-lg transition flex items-center gap-1 {{ request()->routeIs('admin.profile.*') ? 'bg-[#2E2A26] text-white shadow-xs font-semibold' : 'text-stone-300 hover:text-white hover:bg-stone-800/60' }}">
                        <span class="material-symbols-outlined text-[16px]">badge</span>
                        <span>Bio</span>
                    </a>

                    <a href="{{ route('admin.education.index') }}" 
                       class="px-2.5 py-1.5 rounded-lg transition flex items-center gap-1 {{ request()->routeIs('admin.education.*') ? 'bg-[#2E2A26] text-white shadow-xs font-semibold' : 'text-stone-300 hover:text-white hover:bg-stone-800/60' }}">
                        <span class="material-symbols-outlined text-[16px]">school</span>
                        <span>Education</span>
                    </a>

                    <a href="{{ route('admin.experiences.index') }}" 
                       class="px-2.5 py-1.5 rounded-lg transition flex items-center gap-1 {{ request()->routeIs('admin.experiences.*') ? 'bg-[#2E2A26] text-white shadow-xs font-semibold' : 'text-stone-300 hover:text-white hover:bg-stone-800/60' }}">
                        <span class="material-symbols-outlined text-[16px]">work</span>
                        <span>Experience</span>
                    </a>

                    <a href="{{ route('admin.projects.index') }}" 
                       class="px-2.5 py-1.5 rounded-lg transition flex items-center gap-1 {{ request()->routeIs('admin.projects.*') ? 'bg-[#2E2A26] text-white shadow-xs font-semibold' : 'text-stone-300 hover:text-white hover:bg-stone-800/60' }}">
                        <span class="material-symbols-outlined text-[16px]">terminal</span>
                        <span>Projects</span>
                    </a>

                    <a href="{{ route('admin.skills.index') }}" 
                       class="px-2.5 py-1.5 rounded-lg transition flex items-center gap-1 {{ request()->routeIs('admin.skills.*') ? 'bg-[#2E2A26] text-white shadow-xs font-semibold' : 'text-stone-300 hover:text-white hover:bg-stone-800/60' }}">
                        <span class="material-symbols-outlined text-[16px]">psychology</span>
                        <span>Skills</span>
                    </a>

                    <span class="w-[1px] h-4 bg-stone-700 mx-1"></span>

                    <!-- Special Tools: ATS Generator -->
                    <a href="{{ route('admin.ats.index') }}" 
                       class="px-3 py-1.5 rounded-lg transition flex items-center gap-1.5 {{ request()->routeIs('admin.ats.*') ? 'bg-amber-400/20 text-amber-300 font-semibold border border-amber-400/30' : 'text-amber-300/80 hover:text-amber-200 hover:bg-amber-400/10' }}">
                        <span class="material-symbols-outlined text-[16px] text-amber-400">description</span>
                        <span>ATS Resume</span>
                    </a>

                    <!-- Inquiries with Unread Badge -->
                    <a href="{{ route('admin.messages.index') }}" 
                       class="px-3 py-1.5 rounded-lg transition flex items-center gap-1.5 {{ request()->routeIs('admin.messages.*') ? 'bg-[#2E2A26] text-white shadow-xs font-semibold' : 'text-stone-300 hover:text-white hover:bg-stone-800/60' }}">
                        <span class="material-symbols-outlined text-[16px]">mail</span>
                        <span>Inquiries</span>
                        @if($unreadInquiries > 0)
                            <span class="px-1.5 py-0.2 rounded-full bg-rose-500 text-white text-[10px] font-bold">
                                {{ $unreadInquiries }}
                            </span>
                        @endif
                    </a>
                </nav>

                <!-- Right: Quick Utilities & Sign Out -->
                <div class="flex items-center gap-2 sm:gap-3">
                    <!-- Language Preview Toggle -->
                    <div class="hidden sm:flex items-center bg-[#1F1C19] border border-stone-800 rounded-lg p-0.5 text-xs font-mono">
                        <a href="{{ route('locale.switch', 'en') }}" 
                           class="px-2 py-1 rounded {{ app()->getLocale() === 'en' ? 'bg-[#2E2A26] text-white font-semibold' : 'text-stone-400 hover:text-stone-200' }}"
                           title="Switch system preview to English">
                            EN
                        </a>
                        <a href="{{ route('locale.switch', 'id') }}" 
                           class="px-2 py-1 rounded {{ app()->getLocale() === 'id' ? 'bg-[#2E2A26] text-white font-semibold' : 'text-stone-400 hover:text-stone-200' }}"
                           title="Switch system preview to Bahasa Indonesia">
                            ID
                        </a>
                    </div>

                    <!-- View Live Portfolio -->
                    <a href="{{ route('portfolio.index') }}" target="_blank" 
                       class="text-xs font-mono text-stone-300 hover:text-white px-2.5 py-1.5 rounded-lg bg-stone-800 hover:bg-stone-700 transition flex items-center gap-1.5 border border-stone-700">
                        <span class="hidden sm:inline">Live Site</span>
                        <span class="material-symbols-outlined text-[14px]">open_in_new</span>
                    </a>

                    <!-- Logout Button -->
                    <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" 
                                class="text-xs font-mono text-rose-300 hover:text-rose-200 px-2.5 py-1.5 rounded-lg bg-rose-950/40 hover:bg-rose-900/50 border border-rose-800/50 flex items-center gap-1 transition"
                                title="Sign out of Manage Console">
                            <span class="material-symbols-outlined text-[14px]">logout</span>
                            <span class="hidden sm:inline">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Mobile Horizontal Tab Bar -->
        <div class="lg:hidden border-t border-stone-800 bg-[#161412] px-3 py-2 overflow-x-auto no-scrollbar flex items-center gap-1.5 text-xs font-mono">
            <a href="{{ route('admin.dashboard') }}" class="px-2.5 py-1 rounded-md whitespace-nowrap {{ request()->routeIs('admin.dashboard') ? 'bg-stone-700 text-white' : 'text-stone-400' }}">Overview</a>
            <a href="{{ route('admin.profile.edit') }}" class="px-2.5 py-1 rounded-md whitespace-nowrap {{ request()->routeIs('admin.profile.*') ? 'bg-stone-700 text-white' : 'text-stone-400' }}">Bio</a>
            <a href="{{ route('admin.education.index') }}" class="px-2.5 py-1 rounded-md whitespace-nowrap {{ request()->routeIs('admin.education.*') ? 'bg-stone-700 text-white' : 'text-stone-400' }}">Education</a>
            <a href="{{ route('admin.experiences.index') }}" class="px-2.5 py-1 rounded-md whitespace-nowrap {{ request()->routeIs('admin.experiences.*') ? 'bg-stone-700 text-white' : 'text-stone-400' }}">Experience</a>
            <a href="{{ route('admin.projects.index') }}" class="px-2.5 py-1 rounded-md whitespace-nowrap {{ request()->routeIs('admin.projects.*') ? 'bg-stone-700 text-white' : 'text-stone-400' }}">Projects</a>
            <a href="{{ route('admin.skills.index') }}" class="px-2.5 py-1 rounded-md whitespace-nowrap {{ request()->routeIs('admin.skills.*') ? 'bg-stone-700 text-white' : 'text-stone-400' }}">Skills</a>
            <a href="{{ route('admin.ats.index') }}" class="px-2.5 py-1 rounded-md whitespace-nowrap {{ request()->routeIs('admin.ats.*') ? 'bg-amber-400/20 text-amber-300' : 'text-amber-400/70' }}">ATS Resume</a>
            <a href="{{ route('admin.messages.index') }}" class="px-2.5 py-1 rounded-md whitespace-nowrap {{ request()->routeIs('admin.messages.*') ? 'bg-stone-700 text-white' : 'text-stone-400' }}">
                Inquiries @if($unreadInquiries > 0)({{ $unreadInquiries }})@endif
            </a>
        </div>
    </header>

    <!-- Main Admin Content Area -->
    <main class="flex-grow py-8 md:py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Toast Notifications / Alerts -->
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-sm flex items-center gap-2.5 shadow-2xs">
                    <span class="material-symbols-outlined text-emerald-600">check_circle</span>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-900 text-sm space-y-1 shadow-2xs">
                    <div class="flex items-center gap-2 font-semibold">
                        <span class="material-symbols-outlined text-rose-600">error</span>
                        <span>Please review the highlighted errors below:</span>
                    </div>
                    <ul class="list-disc list-inside pl-6 text-xs text-rose-800">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Admin Footer -->
    <footer class="border-t border-[#E8E5DC] bg-white py-5 text-center text-xs font-mono text-[#78716C]">
        <p>Portfolio Admin Engine &bull; Subdomain Manage Console &bull; SQLite Persistence</p>
    </footer>

</body>
</html>
