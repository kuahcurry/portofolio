<?php

namespace App\Http\Resources\Api\V1;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Skill
 */
class SkillResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->trans('name'),
            'type' => $this->type,
            'category' => $this->category,
            'proficiency' => $this->proficiency,
            'level' => [
                'key' => $this->level_key,
                'label' => $this->level_label,
            ],
            'description' => $this->trans('description'),
            'icon' => $this->icon,
            'sort_order' => $this->sort_order,
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
