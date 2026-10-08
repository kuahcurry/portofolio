<?php

namespace Tests\Feature;

use Database\Seeders\PortfolioSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HealthStatusTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(PortfolioSeeder::class);
    }

    public function test_health_json_endpoint_returns_operational_structure(): void
    {
        $response = $this->getJson('/status/json');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'timestamp',
                'services' => [
                    'overall',
                    'environment' => [
                        'app_env',
                        'php_version',
                        'laravel_version',
                    ],
                    'database' => [
                        'status',
                        'driver',
                        'latency_ms',
                    ],
                    'cache' => [
                        'status',
                        'driver',
                        'latency_ms',
                    ],
                    'storage' => [
                        'free_space_gb',
                        'total_space_gb',
                        'used_percent',
                    ],
                    'memory' => [
                        'allocated_mb',
                        'peak_mb',
                    ],
                ],
            ]);

        $this->assertContains($response->json('status'), ['operational', 'degraded']);
    }

    public function test_health_html_dashboard_renders(): void
    {
        $response = $this->get('/status');

        $response->assertStatus(200)
            ->assertSee('System Observability')
            ->assertSee('Database')
            ->assertSee('/status/json');
    }
}
