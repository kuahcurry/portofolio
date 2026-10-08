<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>System Health & Telemetry — {{ $profile->name ?? 'Aqief Hakimi' }}</title>
    <meta name="description" content="Real-time observability and service status dashboard for backend services, database latency, and runtime environment.">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,600;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #0c0e12;
            color: #FAF9F6;
        }
        .font-mono {
            font-family: 'JetBrains Mono', monospace;
        }
        .pulse-dot {
            animation: pulse-ring 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes pulse-ring {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(1.15); }
        }
    </style>
</head>
<body class="min-h-screen flex flex-col antialiased selection:bg-[#8F6A3B] selection:text-white">
    <!-- Status Header -->
    <header class="border-b border-white/10 bg-[#12151b]/80 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 h-18 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ url('/') }}" class="flex items-center space-x-3 text-white no-underline group">
                    <span class="w-8 h-8 rounded-lg bg-[#8F6A3B] text-white flex items-center justify-center font-serif font-bold text-sm">
                        {{ substr($profile->name ?? 'A', 0, 1) }}
                    </span>
                    <span class="font-serif text-base font-bold tracking-tight text-white group-hover:text-[#d4af37] transition-colors">
                        {{ $profile->name ?? 'Aqief Hakimi' }}
                    </span>
                </a>
                <span class="text-white/20">/</span>
                <span class="text-xs font-mono tracking-wider uppercase text-white/60">System Observability</span>
            </div>

            <div class="flex items-center space-x-4 text-xs font-mono">
                <a href="{{ url('/api/docs') }}" class="text-[#d4af37] hover:underline flex items-center gap-1.5 bg-[#8F6A3B]/10 border border-[#8F6A3B]/30 px-3 py-1.5 rounded-lg transition">
                    <span class="material-symbols-outlined text-sm">api</span>
                    <span>API Docs</span>
                </a>
                <a href="{{ url('/status/json') }}" target="_blank" class="text-white/70 hover:text-white flex items-center gap-1 bg-white/5 border border-white/10 px-3 py-1.5 rounded-lg transition">
                    <span class="material-symbols-outlined text-sm">data_object</span>
                    <span>JSON Metric</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <main class="flex-1 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full">
        <!-- Banner: Current Status -->
        <div class="bg-gradient-to-r {{ $metrics['overall'] === 'operational' ? 'from-emerald-950/40 via-[#12151b] to-[#12151b] border-emerald-500/30' : 'from-amber-950/40 via-[#12151b] to-[#12151b] border-amber-500/30' }} border rounded-2xl p-6 sm:p-8 mb-8 backdrop-blur-md shadow-xl">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center space-x-4">
                    <div class="w-4 h-4 rounded-full {{ $metrics['overall'] === 'operational' ? 'bg-emerald-400' : 'bg-amber-400' }} pulse-dot shadow-lg shadow-emerald-500/30"></div>
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-white font-serif">
                            {{ $metrics['overall'] === 'operational' ? 'All Systems Operational' : 'Degraded Performance Detected' }}
                        </h1>
                        <p class="text-white/60 text-sm mt-1">
                            Live telemetry of backend services, micro-benchmarks, and cloud runtime health.
                        </p>
                    </div>
                </div>
                <div class="text-right sm:text-right">
                    <span class="text-xs font-mono text-white/50 block">Last Probed:</span>
                    <span class="text-xs font-mono text-white/90 font-medium">{{ now()->format('Y-m-d H:i:s T') }}</span>
                </div>
            </div>
        </div>

        <!-- 3-Column Metrics Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Database Health -->
            <div class="bg-[#141820] border border-white/10 rounded-xl p-6 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-2 text-white/80">
                            <span class="material-symbols-outlined text-xl text-[#8F6A3B]">database</span>
                            <h2 class="font-mono text-sm font-semibold uppercase tracking-wider">Database Engine</h2>
                        </div>
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-mono font-medium {{ $metrics['database']['status'] === 'healthy' ? 'bg-emerald-950/80 text-emerald-300 border border-emerald-500/30' : 'bg-red-950/80 text-red-300 border border-red-500/30' }}">
                            {{ strtoupper($metrics['database']['status']) }}
                        </span>
                    </div>
                    <div class="space-y-2 text-xs font-mono">
                        <div class="flex justify-between py-1 border-b border-white/5">
                            <span class="text-white/50">Driver</span>
                            <span class="text-white/90 uppercase font-semibold">{{ $metrics['database']['driver'] }}</span>
                        </div>
                        <div class="flex justify-between py-1 border-b border-white/5">
                            <span class="text-white/50">Ping Latency</span>
                            <span class="text-emerald-400 font-semibold">{{ $metrics['database']['latency_ms'] }} ms</span>
                        </div>
                        <div class="flex justify-between py-1">
                            <span class="text-white/50">Read Benchmark</span>
                            <span class="text-white/90">SELECT 1 (Direct)</span>
                        </div>
                    </div>
                </div>
                <div class="mt-4 pt-3 border-t border-white/5 text-[11px] font-mono text-white/40">
                    Connection pool active & responsive.
                </div>
            </div>

            <!-- Cache Store Health -->
            <div class="bg-[#141820] border border-white/10 rounded-xl p-6 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-2 text-white/80">
                            <span class="material-symbols-outlined text-xl text-[#8F6A3B]">memory</span>
                            <h2 class="font-mono text-sm font-semibold uppercase tracking-wider">Cache Layer</h2>
                        </div>
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-mono font-medium {{ $metrics['cache']['status'] === 'healthy' ? 'bg-emerald-950/80 text-emerald-300 border border-emerald-500/30' : 'bg-amber-950/80 text-amber-300 border border-amber-500/30' }}">
                            {{ strtoupper($metrics['cache']['status']) }}
                        </span>
                    </div>
                    <div class="space-y-2 text-xs font-mono">
                        <div class="flex justify-between py-1 border-b border-white/5">
                            <span class="text-white/50">Driver</span>
                            <span class="text-white/90 uppercase font-semibold">{{ $metrics['cache']['driver'] }}</span>
                        </div>
                        <div class="flex justify-between py-1 border-b border-white/5">
                            <span class="text-white/50">Roundtrip Latency</span>
                            <span class="text-emerald-400 font-semibold">{{ $metrics['cache']['latency_ms'] }} ms</span>
                        </div>
                        <div class="flex justify-between py-1">
                            <span class="text-white/50">Probe Verification</span>
                            <span class="text-white/90">SET &rarr; GET &rarr; DEL OK</span>
                        </div>
                    </div>
                </div>
                <div class="mt-4 pt-3 border-t border-white/5 text-[11px] font-mono text-white/40">
                    High throughput in-memory caching operational.
                </div>
            </div>

            <!-- Runtime & Framework -->
            <div class="bg-[#141820] border border-white/10 rounded-xl p-6 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-2 text-white/80">
                            <span class="material-symbols-outlined text-xl text-[#8F6A3B]">terminal</span>
                            <h2 class="font-mono text-sm font-semibold uppercase tracking-wider">Application Stack</h2>
                        </div>
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-mono font-medium bg-white/10 text-white/90 border border-white/10">
                            PHP {{ PHP_MAJOR_VERSION }}.{{ PHP_MINOR_VERSION }}
                        </span>
                    </div>
                    <div class="space-y-2 text-xs font-mono">
                        <div class="flex justify-between py-1 border-b border-white/5">
                            <span class="text-white/50">Laravel Core</span>
                            <span class="text-white/90 font-semibold">v{{ $metrics['environment']['laravel_version'] }}</span>
                        </div>
                        <div class="flex justify-between py-1 border-b border-white/5">
                            <span class="text-white/50">Environment</span>
                            <span class="text-white/90 uppercase">{{ $metrics['environment']['app_env'] }}</span>
                        </div>
                        <div class="flex justify-between py-1">
                            <span class="text-white/50">Host Platform</span>
                            <span class="text-white/90">{{ $metrics['environment']['os_family'] }} (Linux x86_64)</span>
                        </div>
                    </div>
                </div>
                <div class="mt-4 pt-3 border-t border-white/5 text-[11px] font-mono text-white/40">
                    Production container baseline ready.
                </div>
            </div>
        </div>

        <!-- Telemetry & Host Metrics -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Memory & Disk -->
            <div class="bg-[#141820] border border-white/10 rounded-xl p-6 shadow-sm">
                <div class="flex items-center space-x-2 mb-4 text-white/80">
                    <span class="material-symbols-outlined text-xl text-[#8F6A3B]">hard_drive</span>
                    <h2 class="font-mono text-sm font-semibold uppercase tracking-wider">Resource Allocation</h2>
                </div>
                <div class="space-y-4 text-xs font-mono">
                    <div>
                        <div class="flex justify-between text-white/70 mb-1">
                            <span>Process Memory Allocated</span>
                            <span class="text-white font-semibold">{{ $metrics['memory']['allocated_mb'] }} MB (Peak: {{ $metrics['memory']['peak_mb'] }} MB)</span>
                        </div>
                        <div class="w-full bg-white/5 rounded-full h-2 overflow-hidden">
                            <div class="bg-[#8F6A3B] h-2 rounded-full" style="width: {{ min(100, max(5, $metrics['memory']['peak_mb'])) }}%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between text-white/70 mb-1">
                            <span>Persistent Storage Usage</span>
                            <span class="text-white font-semibold">{{ $metrics['storage']['used_percent'] }}% ({{ $metrics['storage']['free_space_gb'] }} GB free)</span>
                        </div>
                        <div class="w-full bg-white/5 rounded-full h-2 overflow-hidden">
                            <div class="bg-emerald-500 h-2 rounded-full" style="width: {{ $metrics['storage']['used_percent'] }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cloud Architecture & Reliability Proof -->
            <div class="bg-[#141820] border border-white/10 rounded-xl p-6 shadow-sm">
                <div class="flex items-center space-x-2 mb-4 text-white/80">
                    <span class="material-symbols-outlined text-xl text-[#8F6A3B]">cloud_done</span>
                    <h2 class="font-mono text-sm font-semibold uppercase tracking-wider">Cloud & SRE Competencies</h2>
                </div>
                <div class="space-y-3 text-xs text-white/70 leading-relaxed">
                    <div class="flex items-start space-x-2">
                        <span class="material-symbols-outlined text-sm text-emerald-400 mt-0.5">check_circle</span>
                        <span><strong>CI/CD Pipelines:</strong> Automated GitHub Actions workflow running static analysis, PSR-12 code style checks, and regression suites.</span>
                    </div>
                    <div class="flex items-start space-x-2">
                        <span class="material-symbols-outlined text-sm text-emerald-400 mt-0.5">check_circle</span>
                        <span><strong>REST API Architecture:</strong> Rate-limited endpoints (60 req/min) with standard OpenAPI 3.0.3 specification and interactive Scalar sandbox.</span>
                    </div>
                    <div class="flex items-start space-x-2">
                        <span class="material-symbols-outlined text-sm text-emerald-400 mt-0.5">check_circle</span>
                        <span><strong>Synthetic Telemetry:</strong> Public JSON health probe endpoint compatible with Prometheus, Uptime Kuma, and Datadog heartbeat checks.</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back to Portfolio Link -->
        <div class="text-center pt-4">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-xs font-mono text-white/70 hover:text-white transition">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                <span>Return to Portfolio Home</span>
            </a>
        </div>
    </main>

    <!-- Footer -->
    <footer class="border-t border-white/10 py-6 text-center text-xs font-mono text-white/40">
        &copy; {{ date('Y') }} {{ $profile->name ?? 'Aqief Hakimi' }} &bull; Monitored & Engineered with Laravel & Tailwind CSS
    </footer>
</body>
</html>
