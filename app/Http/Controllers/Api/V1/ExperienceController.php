<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\ExperienceResource;
use App\Models\Experience;
use Illuminate\Http\JsonResponse;

class ExperienceController extends Controller
{
    /**
     * List all professional experiences.
     */
    public function index(): JsonResponse
    {
        $experiences = Experience::orderBy('sort_order')->get();

        return ExperienceResource::collection($experiences)
            ->additional([
                'status' => 'success',
                'meta' => [
                    'count' => $experiences->count(),
                    'api_version' => 'v1',
                ],
            ])
            ->response();
    }
}
