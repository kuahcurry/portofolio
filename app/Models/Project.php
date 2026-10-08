<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'title_id',
        'slug',
        'tagline',
        'tagline_id',
        'description',
        'description_id',
        'thumbnail',
        'category',
        'category_id',
        'github_url',
        'website_url',
        'certificate_url',
        'certificate_image',
        'technologies',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'technologies' => 'array',
        'is_featured' => 'boolean',
    ];

    /**
     * Get the translated attribute based on the active locale.
     */
    public function trans(string $field): mixed
    {
        $locale = app()->getLocale();
        if ($locale === 'id' && ! empty($this->{$field.'_id'})) {
            return $this->{$field.'_id'};
        }

        return $this->{$field};
    }
}
