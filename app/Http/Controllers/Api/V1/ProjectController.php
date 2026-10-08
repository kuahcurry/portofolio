<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\ProjectResource;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * List all projects with optional category and featured filters.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Project::query();

        if ($request->has('category')) {
            $category = $request->query('category');
            $query->where(function ($q) use ($category) {
                $q->where('category', $category)
                    ->orWhere('category_id', $category);
            });
        }

        if ($request->boolean('featured')) {
            $query->where('is_featured', true);
        }

        if ($request->has('search')) {
            $search = '%'.$request->query('search').'%';
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', $search)
                    ->orWhere('title_id', 'like', $search)
                    ->orWhere('description', 'like', $search);
            });
        }

        $projects = $query->orderBy('sort_order')->get();

        return ProjectResource::collection($projects)
            ->additional([
                'status' => 'success',
                'meta' => [
                    'count' => $projects->count(),
                    'api_version' => 'v1',
                ],
            ])
            ->response();
    }

    /**
     * Display a specific project by id or slug.
     */
    public function show(string $idOrSlug): JsonResponse
    {
        $project = Project::where('id', $idOrSlug)
            ->orWhere('slug', $idOrSlug)
            ->first();

        if (! $project) {
            return response()->json([
                'status' => 'error',
                'message' => 'Project not found.',
            ], 404);
        }

        return (new ProjectResource($project))
            ->additional([
                'status' => 'success',
                'meta' => ['api_version' => 'v1'],
            ])
            ->response();
    }
}
