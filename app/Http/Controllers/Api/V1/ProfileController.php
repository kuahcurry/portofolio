<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\ProfileResource;
use App\Models\Profile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display candidate profile and bio.
     */
    public function show(Request $request): JsonResponse
    {
        $profile = Profile::first();

        if (! $profile) {
            return response()->json([
                'status' => 'error',
                'message' => 'Profile information not found.',
            ], 404);
        }

        return (new ProfileResource($profile))
            ->additional([
                'status' => 'success',
                'meta' => [
                    'active_locale' => app()->getLocale(),
                    'api_version' => 'v1',
                ],
            ])
            ->response();
    }
}
