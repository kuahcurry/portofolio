<?php

namespace App\Http\Resources\Api\V1;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Project
 */
class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->trans('title'),
            'slug' => $this->slug,
            'tagline' => $this->trans('tagline'),
            'description' => $this->trans('description'),
            'category' => $this->trans('category'),
            'thumbnail_url' => $this->thumbnail,
            'links' => [
                'github' => $this->github_url,
                'website' => $this->website_url,
                'certificate' => $this->certificate_url,
            ],
            'certificate_image_url' => $this->certificate_image,
            'technologies' => $this->technologies ?? [],
            'is_featured' => (bool) $this->is_featured,
            'sort_order' => $this->sort_order,
            'translations' => [
                'en' => [
                    'title' => $this->title,
                    'tagline' => $this->tagline,
                    'description' => $this->description,
                    'category' => $this->category,
                ],
                'id' => [
                    'title' => $this->title_id,
                    'tagline' => $this->tagline_id,
                    'description' => $this->description_id,
                    'category' => $this->category_id,
                ],
            ],
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
