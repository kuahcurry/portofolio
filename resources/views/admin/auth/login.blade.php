<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login — Portfolio Manage Console</title>

    <!-- Favicon & Touch Icon: Authentic New York Times Initial 'A' Monogram -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.svg') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600&family=Playfair+Display:wght@700&family=Plus+Jakarta+Sans:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FAF9F6] text-[#1C1917] min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        
        <!-- Classical Seal -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-[#1C1917] text-[#FAF9F6] font-serif font-bold text-2xl shadow-md mb-4">
                M
            </div>
            <h1 class="font-serif text-3xl font-bold text-[#1C1917]">Manage Console</h1>
            <p class="text-sm text-[#78716C] font-mono mt-1">subdomain: manage. &bull; authentication required</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-2xl border border-[#E8E5DC] p-8 shadow-sm">
            @if(session('success'))
                <div class="mb-6 p-3 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-3 rounded-lg bg-rose-50 border border-rose-200 text-rose-900 text-xs">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-mono uppercase tracking-wider text-[#78716C] mb-1.5 font-semibold">
                        Email Address
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email', 'admin@portfolio.local') }}" 
                        required 
                        autofocus
                        class="w-full px-3.5 py-2.5 rounded-lg bg-[#FAF9F6] border border-[#D6D3D1] text-[#1C1917] text-sm focus:border-[#1C1917] focus:ring-1 focus:ring-[#1C1917] outline-none transition"
                    >
                </div>

                <div>
                    <label for="password" class="block text-xs font-mono uppercase tracking-wider text-[#78716C] mb-1.5 font-semibold">
                        Password
                    </label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        required
                        placeholder="••••••••"
                        class="w-full px-3.5 py-2.5 rounded-lg bg-[#FAF9F6] border border-[#D6D3D1] text-[#1C1917] text-sm focus:border-[#1C1917] focus:ring-1 focus:ring-[#1C1917] outline-none transition"
                    >
                </div>

                <div class="flex items-center justify-between text-xs">
                    <label class="flex items-center space-x-2 text-[#57534E] cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-[#D6D3D1] text-[#1C1917] focus:ring-[#1C1917]">
                        <span>Remember credentials</span>
                    </label>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-3 px-4 rounded-lg bg-[#1C1917] text-[#FAF9F6] font-medium text-sm hover:bg-[#322F2D] transition shadow-xs flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-sm">lock_open</span>
                        <span>Sign In to Console</span>
                    </button>
                </div>
            </form>

            <!-- Default Credentials Tip -->
            <div class="mt-6 pt-5 border-t border-[#F4F2EB] text-center">
                <p class="text-[11px] font-mono text-[#78716C]">
                    Default access: <span class="text-[#1C1917] font-semibold">admin@portfolio.local</span> / <span class="text-[#1C1917] font-semibold">admin12345</span>
                </p>
                <div class="mt-3">
                    <a href="{{ route('portfolio.index') }}" class="text-xs text-[#8F6A3B] hover:underline font-mono">
                        &larr; Return to Public Portfolio
                    </a>
                </div>
            </div>
        </div>

    </div>
</body>
</html>
