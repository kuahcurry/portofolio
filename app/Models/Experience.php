<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'role',
        'role_id',
        'company',
        'company_url',
        'certificate_url',
        'certificate_image',
        'location',
        'start_date',
        'end_date',
        'is_current',
        'description',
        'description_id',
        'highlights',
        'highlights_id',
        'technologies',
        'sort_order',
    ];

    protected $casts = [
        'is_current' => 'boolean',
        'highlights' => 'array',
        'highlights_id' => 'array',
        'technologies' => 'array',
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
