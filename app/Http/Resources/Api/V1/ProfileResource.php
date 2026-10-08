<?php

namespace App\Http\Resources\Api\V1;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Profile
 */
class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $locale = $request->query('lang', app()->getLocale());
        if (in_array($locale, ['en', 'id'])) {
            app()->setLocale($locale);
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'title' => $this->trans('title'),
            'tagline' => $this->trans('tagline'),
            'bio' => $this->trans('bio'),
            'short_bio' => $this->short_bio,
            'avatar_url' => $this->avatar,
            'location' => $this->location,
            'contact' => [
                'email' => $this->email,
                'phone' => $this->phone,
            ],
            'social_links' => [
                'github' => $this->github_url,
                'linkedin' => $this->linkedin_url,
                'website' => $this->website_url,
                'twitter' => $this->twitter_url,
                'resume' => $this->resume_url,
            ],
            'availability_status' => $this->availability_status,
            'years_of_experience' => $this->years_of_experience,
            'translations' => [
                'en' => [
                    'title' => $this->title,
                    'tagline' => $this->tagline,
                    'bio' => $this->bio,
                ],
                'id' => [
                    'title' => $this->title_id,
                    'tagline' => $this->tagline_id,
                    'bio' => $this->bio_id,
                ],
            ],
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
