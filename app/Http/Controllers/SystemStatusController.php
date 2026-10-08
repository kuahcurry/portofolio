<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SystemStatusController extends Controller
{
    /**
     * Display the System Health and Observability dashboard.
     */
    public function index(): View
    {
        $profile = Profile::first();
        $metrics = $this->collectMetrics();

        return view('status.index', [
            'profile' => $profile,
            'metrics' => $metrics,
        ]);
    }

    /**
     * Return JSON system health metrics for synthetic monitors (Uptime Kuma, Datadog, Prometheus).
     */
    public function json(): JsonResponse
    {
        $metrics = $this->collectMetrics();
        $isHealthy = $metrics['database']['status'] === 'healthy' && $metrics['cache']['status'] === 'healthy';

        return response()->json([
            'status' => $isHealthy ? 'operational' : 'degraded',
            'timestamp' => now()->toIso8601String(),
            'services' => $metrics,
        ], $isHealthy ? 200 : 503);
    }

    /**
     * Collect live health checks and performance benchmarks.
     *
     * @return array<string, mixed>
     */
    private function collectMetrics(): array
    {
        // 1. Database Connectivity & Query Latency Benchmark
        $dbStatus = 'healthy';
        $dbLatency = 0.0;
        $dbConnection = config('database.default');
        try {
            $dbStart = microtime(true);
            DB::select('SELECT 1');
            $dbLatency = round((microtime(true) - $dbStart) * 1000, 2);
        } catch (\Throwable $e) {
            $dbStatus = 'unhealthy: '.$e->getMessage();
        }

        // 2. Cache Store Connectivity & Read/Write Latency Benchmark
        $cacheStatus = 'healthy';
        $cacheLatency = 0.0;
        $cacheStore = config('cache.default');
        try {
            $cacheStart = microtime(true);
            $probeKey = 'health_probe_'.bin2hex(random_bytes(4));
            Cache::put($probeKey, 'probe_val', 10);
            $probeVal = Cache::get($probeKey);
            Cache::forget($probeKey);
            $cacheLatency = round((microtime(true) - $cacheStart) * 1000, 2);
            if ($probeVal !== 'probe_val') {
                $cacheStatus = 'degraded';
            }
        } catch (\Throwable $e) {
            $cacheStatus = 'unhealthy: '.$e->getMessage();
        }

        // 3. Disk Space & Storage
        $diskPath = storage_path();
        $freeDisk = @disk_free_space($diskPath);
        $totalDisk = @disk_total_space($diskPath);
        $diskUsagePercent = ($freeDisk !== false && $totalDisk && $totalDisk > 0)
            ? round((($totalDisk - $freeDisk) / $totalDisk) * 100, 1)
            : 0;

        // 4. Memory Usage
        $memoryUsage = round(memory_get_usage(true) / 1024 / 1024, 2);
        $memoryPeak = round(memory_get_peak_usage(true) / 1024 / 1024, 2);

        // 5. System Load
        $sysLoad = function_exists('sys_getloadavg') ? @sys_getloadavg() : null;

        return [
            'overall' => ($dbStatus === 'healthy' && $cacheStatus === 'healthy') ? 'operational' : 'degraded',
            'environment' => [
                'app_env' => config('app.env'),
                'debug_mode' => (bool) config('app.debug'),
                'php_version' => PHP_VERSION,
                'laravel_version' => app()->version(),
                'server_software' => $_SERVER['SERVER_SOFTWARE'] ?? 'Nginx / PHP-FPM',
                'os_family' => PHP_OS_FAMILY,
                'timezone' => config('app.timezone'),
            ],
            'database' => [
                'status' => $dbStatus,
                'driver' => $dbConnection,
                'latency_ms' => $dbLatency,
            ],
            'cache' => [
                'status' => $cacheStatus,
                'driver' => $cacheStore,
                'latency_ms' => $cacheLatency,
            ],
            'storage' => [
                'free_space_gb' => $freeDisk !== false ? round($freeDisk / 1024 / 1024 / 1024, 2) : 'N/A',
                'total_space_gb' => $totalDisk !== false ? round($totalDisk / 1024 / 1024 / 1024, 2) : 'N/A',
                'used_percent' => $diskUsagePercent,
            ],
            'memory' => [
                'allocated_mb' => $memoryUsage,
                'peak_mb' => $memoryPeak,
            ],
            'load' => [
                '1m' => $sysLoad[0] ?? 0.0,
                '5m' => $sysLoad[1] ?? 0.0,
                '15m' => $sysLoad[2] ?? 0.0,
            ],
        ];
    }
}
