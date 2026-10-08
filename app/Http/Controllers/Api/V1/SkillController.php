<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\SkillResource;
use App\Models\Skill;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * List all technical and soft skills, optionally grouped by domain/category.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Skill::query();

        if ($request->has('type')) {
            $query->where('type', $request->query('type'));
        }

        if ($request->has('category')) {
            $query->where('category', $request->query('category'));
        }

        $skills = $query->orderBy('sort_order')->get();

        if ($request->boolean('grouped')) {
            $technical = $skills->where('type', 'technical');
            $soft = $skills->where('type', 'soft');

            return response()->json([
                'status' => 'success',
                'data' => [
                    'technical' => [
                        'programming_languages' => SkillResource::collection($technical->where('category', 'programming_language')->values()),
                        'frameworks' => SkillResource::collection($technical->where('category', 'framework')->values()),
                        'databases' => SkillResource::collection($technical->where('category', 'database')->values()),
                        'tools_cloud' => SkillResource::collection($technical->where('category', 'tools')->values()),
                    ],
                    'soft_skills' => SkillResource::collection($soft->values()),
                ],
                'meta' => [
                    'total_skills' => $skills->count(),
                    'api_version' => 'v1',
                ],
            ]);
        }

        return SkillResource::collection($skills)
            ->additional([
                'status' => 'success',
                'meta' => [
                    'count' => $skills->count(),
                    'api_version' => 'v1',
                ],
            ])
            ->response();
    }
}
