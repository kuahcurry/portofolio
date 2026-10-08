<?php

namespace App\Http\Resources\Api\V1;

use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Education
 */
class EducationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'institution' => $this->institution,
            'degree' => $this->trans('degree'),
            'field_of_study' => $this->trans('field_of_study'),
            'start_year' => $this->start_year,
            'end_year' => $this->end_year,
            'grade' => $this->grade,
            'description' => $this->trans('description'),
            'achievements' => $this->trans('achievements') ?? [],
            'sort_order' => $this->sort_order,
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
