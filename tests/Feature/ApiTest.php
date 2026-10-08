<?php

namespace Tests\Feature;

use Database\Seeders\PortfolioSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(PortfolioSeeder::class);
    }

    public function test_api_v1_profile_returns_success_and_valid_structure(): void
    {
        $response = $this->getJson('/api/v1/profile');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'title',
                    'tagline',
                    'bio',
                    'contact' => ['email'],
                    'social_links' => ['github', 'linkedin'],
                    'translations' => ['en', 'id'],
                ],
            ]);
    }

    public function test_api_v1_profile_supports_language_query_param(): void
    {
        $responseEn = $this->getJson('/api/v1/profile?lang=en');
        $responseEn->assertStatus(200);

        $responseId = $this->getJson('/api/v1/profile?lang=id');
        $responseId->assertStatus(200);
    }

    public function test_api_v1_projects_returns_list_with_expected_keys(): void
    {
        $response = $this->getJson('/api/v1/projects');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'slug',
                        'technologies',
                        'links',
                    ],
                ],
                'status',
                'meta' => ['count', 'api_version'],
            ]);
    }

    public function test_api_v1_projects_filters_featured(): void
    {
        $response = $this->getJson('/api/v1/projects?featured=1');

        $response->assertStatus(200);
        $projects = $response->json('data');
        $this->assertNotEmpty($projects);
        foreach ($projects as $project) {
            $this->assertTrue($project['is_featured']);
        }
    }

    public function test_api_v1_skills_returns_list_and_grouped_structure(): void
    {
        $response = $this->getJson('/api/v1/skills');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'type',
                        'category',
                    ],
                ],
                'status',
                'meta' => ['count', 'api_version'],
            ]);

        $responseGrouped = $this->getJson('/api/v1/skills?grouped=1');
        $responseGrouped->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                    'technical' => [
                        'programming_languages',
                        'frameworks',
                        'databases',
                        'tools_cloud',
                    ],
                    'soft_skills',
                ],
                'meta' => ['total_skills', 'api_version'],
            ]);
    }

    public function test_api_v1_experiences_returns_collection(): void
    {
        $response = $this->getJson('/api/v1/experiences');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'role',
                        'company',
                        'start_date',
                    ],
                ],
                'status',
                'meta' => ['count', 'api_version'],
            ]);
    }

    public function test_api_v1_education_returns_collection(): void
    {
        $response = $this->getJson('/api/v1/education');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'institution',
                        'degree',
                    ],
                ],
                'status',
                'meta' => ['count', 'api_version'],
            ]);
    }

    public function test_api_openapi_json_returns_valid_spec(): void
    {
        $response = $this->get('/api/v1/openapi.json');

        $response->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJsonFragment([
                'openapi' => '3.0.3',
            ]);
    }

    public function test_api_docs_ui_renders_scalar(): void
    {
        $response = $this->get('/api/docs');

        $response->assertStatus(200)
            ->assertSee('@scalar/api-reference')
            ->assertSee('/api/v1/openapi.json');
    }
}
