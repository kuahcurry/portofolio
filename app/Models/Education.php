<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'education';

    protected $fillable = [
        'institution',
        'degree',
        'degree_id',
        'field_of_study',
        'field_of_study_id',
        'start_year',
        'end_year',
        'grade',
        'description',
        'description_id',
        'achievements',
        'achievements_id',
        'sort_order',
    ];

    protected $casts = [
        'achievements' => 'array',
        'achievements_id' => 'array',
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
