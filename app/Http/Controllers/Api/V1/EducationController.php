<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\EducationResource;
use App\Models\Education;
use Illuminate\Http\JsonResponse;

class EducationController extends Controller
{
    /**
     * List all educational backgrounds.
     */
    public function index(): JsonResponse
    {
        $education = Education::orderBy('sort_order')->get();

        return EducationResource::collection($education)
            ->additional([
                'status' => 'success',
                'meta' => [
                    'count' => $education->count(),
                    'api_version' => 'v1',
                ],
            ])
            ->response();
    }
}
