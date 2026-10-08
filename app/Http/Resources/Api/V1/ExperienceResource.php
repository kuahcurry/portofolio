<?php

namespace App\Http\Resources\Api\V1;

use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Experience
 */
class ExperienceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'role' => $this->trans('role'),
            'company' => $this->company,
            'company_url' => $this->company_url,
            'location' => $this->location,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'is_current' => (bool) $this->is_current,
            'description' => $this->trans('description'),
            'highlights' => $this->trans('highlights') ?? [],
            'technologies' => $this->technologies ?? [],
            'certificate' => [
                'url' => $this->certificate_url,
                'image_url' => $this->certificate_image,
            ],
            'sort_order' => $this->sort_order,
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
