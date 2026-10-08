<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class DocsController extends Controller
{
    /**
     * Render the interactive Scalar API documentation viewer.
     */
    public function index(): View
    {
        $profile = Profile::first();

        return view('api.docs', compact('profile'));
    }

    /**
     * Provide OpenAPI 3.0 specification in JSON format.
     */
    public function openApiJson(): JsonResponse
    {
        $profile = Profile::first();
        $appName = $profile->name ?? 'Aqief Hakimi';
        $appTitle = $profile->title ?? 'Backend Engineer & Cloud Computing Specialist';
        $baseUrl = url('/api/v1');

        $spec = [
            'openapi' => '3.0.3',
            'info' => [
                'title' => "{$appName} — Portfolio & Engineering API",
                'version' => '1.0.0',
                'description' => "Public, read-only RESTful API showcasing the engineering achievements, project architectures, credentials, and technical capabilities of {$appName} ({$appTitle}).\n\nAll endpoints support `?lang=en` or `?lang=id` for bilingual localization, return standard JSON envelope structures, and are rate-limited to 60 requests per minute.",
                'contact' => [
                    'name' => $appName,
                    'email' => $profile->email ?? 'aqefhakimi32@gmail.com',
                    'url' => $profile->website_url ?? 'https://github.com/kuahcurry',
                ],
                'license' => [
                    'name' => 'MIT',
                    'url' => 'https://opensource.org/licenses/MIT',
                ],
            ],
            'servers' => [
                [
                    'url' => $baseUrl,
                    'description' => 'Current Environment API Base (v1)',
                ],
            ],
            'paths' => [
                '/profile' => [
                    'get' => [
                        'tags' => ['Profile & Bio'],
                        'summary' => 'Retrieve Candidate Profile',
                        'description' => 'Returns executive bio, contact coordinates, social handles, career availability status, and bilingual translations.',
                        'parameters' => [
                            [
                                'name' => 'lang',
                                'in' => 'query',
                                'required' => false,
                                'description' => 'Target language locale (`en` or `id`)',
                                'schema' => ['type' => 'string', 'enum' => ['en', 'id'], 'default' => 'en'],
                            ],
                        ],
                        'responses' => [
                            '200' => [
                                'description' => 'Candidate profile details',
                                'content' => [
                                    'application/json' => [
                                        'schema' => [
                                            'type' => 'object',
                                            'properties' => [
                                                'data' => ['$ref' => '#/components/schemas/Profile'],
                                                'status' => ['type' => 'string', 'example' => 'success'],
                                                'meta' => [
                                                    'type' => 'object',
                                                    'properties' => [
                                                        'active_locale' => ['type' => 'string', 'example' => 'en'],
                                                        'api_version' => ['type' => 'string', 'example' => 'v1'],
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                '/projects' => [
                    'get' => [
                        'tags' => ['Projects'],
                        'summary' => 'List Engineering Projects',
                        'description' => 'Filter and retrieve software engineering projects, system architectures, credentials, and live demo links.',
                        'parameters' => [
                            [
                                'name' => 'category',
                                'in' => 'query',
                                'required' => false,
                                'description' => 'Filter projects by domain (e.g. Backend, Cloud, Full-Stack)',
                                'schema' => ['type' => 'string'],
                            ],
                            [
                                'name' => 'featured',
                                'in' => 'query',
                                'required' => false,
                                'description' => 'Filter only featured marquee projects',
                                'schema' => ['type' => 'boolean'],
                            ],
                            [
                                'name' => 'search',
                                'in' => 'query',
                                'required' => false,
                                'description' => 'Keyword search across titles and descriptions',
                                'schema' => ['type' => 'string'],
                            ],
                            [
                                'name' => 'lang',
                                'in' => 'query',
                                'required' => false,
                                'description' => 'Language locale (`en` or `id`)',
                                'schema' => ['type' => 'string', 'enum' => ['en', 'id']],
                            ],
                        ],
                        'responses' => [
                            '200' => [
                                'description' => 'Array of projects matching filters',
                                'content' => [
                                    'application/json' => [
                                        'schema' => [
                                            'type' => 'object',
                                            'properties' => [
                                                'data' => [
                                                    'type' => 'array',
                                                    'items' => ['$ref' => '#/components/schemas/Project'],
                                                ],
                                                'status' => ['type' => 'string', 'example' => 'success'],
                                                'meta' => [
                                                    'type' => 'object',
                                                    'properties' => [
                                                        'count' => ['type' => 'integer', 'example' => 6],
                                                        'api_version' => ['type' => 'string', 'example' => 'v1'],
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                '/projects/{idOrSlug}' => [
                    'get' => [
                        'tags' => ['Projects'],
                        'summary' => 'Retrieve Single Project Case Study',
                        'description' => 'Returns full architecture, credentials, and details for a project identified by its numeric ID or URL slug.',
                        'parameters' => [
                            [
                                'name' => 'idOrSlug',
                                'in' => 'path',
                                'required' => true,
                                'description' => 'Project primary ID or slug handle',
                                'schema' => ['type' => 'string'],
                            ],
                            [
                                'name' => 'lang',
                                'in' => 'query',
                                'required' => false,
                                'schema' => ['type' => 'string', 'enum' => ['en', 'id']],
                            ],
                        ],
                        'responses' => [
                            '200' => [
                                'description' => 'Project found',
                                'content' => [
                                    'application/json' => [
                                        'schema' => [
                                            'type' => 'object',
                                            'properties' => [
                                                'data' => ['$ref' => '#/components/schemas/Project'],
                                                'status' => ['type' => 'string', 'example' => 'success'],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                            '404' => [
                                'description' => 'Project not found',
                                'content' => [
                                    'application/json' => [
                                        'schema' => ['$ref' => '#/components/schemas/ErrorResponse'],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                '/skills' => [
                    'get' => [
                        'tags' => ['Skills & Stack'],
                        'summary' => 'List Technical & Soft Skills',
                        'description' => 'Returns categorized competencies across programming languages, backend frameworks, cloud & devops, databases, and architectural leadership.',
                        'parameters' => [
                            [
                                'name' => 'type',
                                'in' => 'query',
                                'required' => false,
                                'description' => 'Filter by skill type (`technical` or `soft`)',
                                'schema' => ['type' => 'string', 'enum' => ['technical', 'soft']],
                            ],
                            [
                                'name' => 'category',
                                'in' => 'query',
                                'required' => false,
                                'description' => 'Specific category (e.g. `programming_language`, `framework`, `database`, `tools`)',
                                'schema' => ['type' => 'string'],
                            ],
                            [
                                'name' => 'grouped',
                                'in' => 'query',
                                'required' => false,
                                'description' => 'Group skills by domain structure',
                                'schema' => ['type' => 'boolean'],
                            ],
                        ],
                        'responses' => [
                            '200' => [
                                'description' => 'Skills dataset',
                                'content' => [
                                    'application/json' => [
                                        'schema' => [
                                            'type' => 'object',
                                            'properties' => [
                                                'data' => [
                                                    'type' => 'array',
                                                    'items' => ['$ref' => '#/components/schemas/Skill'],
                                                ],
                                                'status' => ['type' => 'string', 'example' => 'success'],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                '/experiences' => [
                    'get' => [
                        'tags' => ['Career Experience'],
                        'summary' => 'List Professional Experience',
                        'description' => 'Chronological career milestones, leadership achievements, applied tech stacks, and verified credential certificates.',
                        'responses' => [
                            '200' => [
                                'description' => 'List of experiences',
                                'content' => [
                                    'application/json' => [
                                        'schema' => [
                                            'type' => 'object',
                                            'properties' => [
                                                'data' => [
                                                    'type' => 'array',
                                                    'items' => ['$ref' => '#/components/schemas/Experience'],
                                                ],
                                                'status' => ['type' => 'string', 'example' => 'success'],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                '/education' => [
                    'get' => [
                        'tags' => ['Education & Honors'],
                        'summary' => 'List Academic Qualifications',
                        'description' => 'University degrees, academic honors, teaching assistant coordinates, and cohort achievements.',
                        'responses' => [
                            '200' => [
                                'description' => 'List of education history',
                                'content' => [
                                    'application/json' => [
                                        'schema' => [
                                            'type' => 'object',
                                            'properties' => [
                                                'data' => [
                                                    'type' => 'array',
                                                    'items' => ['$ref' => '#/components/schemas/Education'],
                                                ],
                                                'status' => ['type' => 'string', 'example' => 'success'],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'components' => [
                'schemas' => [
                    'Profile' => [
                        'type' => 'object',
                        'properties' => [
                            'id' => ['type' => 'integer', 'example' => 1],
                            'name' => ['type' => 'string', 'example' => 'Aqief Hakimi'],
                            'title' => ['type' => 'string', 'example' => 'Backend Engineer & Cloud Computing Specialist'],
                            'tagline' => ['type' => 'string', 'example' => 'Architecting dependable APIs and cloud systems.'],
                            'bio' => ['type' => 'string'],
                            'short_bio' => ['type' => 'string'],
                            'avatar_url' => ['type' => 'string', 'format' => 'uri'],
                            'location' => ['type' => 'string', 'example' => 'Surabaya & Yogyakarta, Indonesia'],
                            'contact' => [
                                'type' => 'object',
                                'properties' => [
                                    'email' => ['type' => 'string', 'format' => 'email'],
                                    'phone' => ['type' => 'string'],
                                ],
                            ],
                            'social_links' => [
                                'type' => 'object',
                                'properties' => [
                                    'github' => ['type' => 'string', 'format' => 'uri'],
                                    'linkedin' => ['type' => 'string', 'format' => 'uri'],
                                    'website' => ['type' => 'string', 'format' => 'uri'],
                                    'resume' => ['type' => 'string'],
                                ],
                            ],
                            'availability_status' => ['type' => 'string'],
                            'years_of_experience' => ['type' => 'integer', 'example' => 2],
                        ],
                    ],
                    'Project' => [
                        'type' => 'object',
                        'properties' => [
                            'id' => ['type' => 'integer', 'example' => 1],
                            'title' => ['type' => 'string'],
                            'slug' => ['type' => 'string'],
                            'tagline' => ['type' => 'string'],
                            'description' => ['type' => 'string'],
                            'category' => ['type' => 'string'],
                            'thumbnail_url' => ['type' => 'string'],
                            'links' => [
                                'type' => 'object',
                                'properties' => [
                                    'github' => ['type' => 'string', 'nullable' => true],
                                    'website' => ['type' => 'string', 'nullable' => true],
                                    'certificate' => ['type' => 'string', 'nullable' => true],
                                ],
                            ],
                            'technologies' => [
                                'type' => 'array',
                                'items' => ['type' => 'string'],
                            ],
                            'is_featured' => ['type' => 'boolean'],
                            'sort_order' => ['type' => 'integer'],
                        ],
                    ],
                    'Skill' => [
                        'type' => 'object',
                        'properties' => [
                            'id' => ['type' => 'integer'],
                            'name' => ['type' => 'string', 'example' => 'Go / Golang'],
                            'type' => ['type' => 'string', 'enum' => ['technical', 'soft']],
                            'category' => ['type' => 'string', 'example' => 'programming_language'],
                            'proficiency' => ['type' => 'string', 'example' => 'advanced'],
                            'level' => [
                                'type' => 'object',
                                'properties' => [
                                    'key' => ['type' => 'string', 'example' => 'advanced'],
                                    'label' => ['type' => 'string', 'example' => 'Advanced'],
                                ],
                            ],
                            'description' => ['type' => 'string'],
                            'icon' => ['type' => 'string'],
                        ],
                    ],
                    'Experience' => [
                        'type' => 'object',
                        'properties' => [
                            'id' => ['type' => 'integer'],
                            'role' => ['type' => 'string'],
                            'company' => ['type' => 'string'],
                            'location' => ['type' => 'string'],
                            'start_date' => ['type' => 'string'],
                            'end_date' => ['type' => 'string'],
                            'is_current' => ['type' => 'boolean'],
                            'description' => ['type' => 'string'],
                            'highlights' => [
                                'type' => 'array',
                                'items' => ['type' => 'string'],
                            ],
                            'technologies' => [
                                'type' => 'array',
                                'items' => ['type' => 'string'],
                            ],
                        ],
                    ],
                    'Education' => [
                        'type' => 'object',
                        'properties' => [
                            'id' => ['type' => 'integer'],
                            'institution' => ['type' => 'string'],
                            'degree' => ['type' => 'string'],
                            'field_of_study' => ['type' => 'string'],
                            'start_year' => ['type' => 'string'],
                            'end_year' => ['type' => 'string'],
                            'grade' => ['type' => 'string'],
                            'achievements' => [
                                'type' => 'array',
                                'items' => ['type' => 'string'],
                            ],
                        ],
                    ],
                    'ErrorResponse' => [
                        'type' => 'object',
                        'properties' => [
                            'status' => ['type' => 'string', 'example' => 'error'],
                            'message' => ['type' => 'string', 'example' => 'Resource not found.'],
                        ],
                    ],
                ],
            ],
        ];

        return response()->json($spec, 200, [
            'Content-Type' => 'application/json',
            'Access-Control-Allow-Origin' => '*',
        ]);
    }
}
