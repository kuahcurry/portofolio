<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'name',
        'name_id',
        'type', // 'technical' or 'soft'
        'category',
        'proficiency',
        'description',
        'description_id',
        'icon',
        'sort_order',
    ];

    public const LEVELS = [
        'expert' => [
            'label' => 'Expert',
            'label_id' => 'Pakar',
            'badge' => 'bg-emerald-50 text-emerald-800 border-emerald-200',
            'dot' => 'bg-emerald-500',
        ],
        'advanced' => [
            'label' => 'Advanced',
            'label_id' => 'Tingkat Lanjut',
            'badge' => 'bg-blue-50 text-blue-800 border-blue-200',
            'dot' => 'bg-blue-500',
        ],
        'intermediate' => [
            'label' => 'Intermediate',
            'label_id' => 'Menengah',
            'badge' => 'bg-amber-50 text-amber-800 border-amber-200',
            'dot' => 'bg-amber-500',
        ],
        'beginner' => [
            'label' => 'Beginner',
            'label_id' => 'Pemula',
            'badge' => 'bg-stone-100 text-stone-700 border-stone-300',
            'dot' => 'bg-stone-400',
        ],
    ];

    /**
     * Get the translated attribute based on the active locale.
     */
    public function trans(string $field): mixed
    {
        $locale = app()->getLocale();
        if ($locale === 'id' && !empty($this->{$field . '_id'})) {
            return $this->{$field . '_id'};
        }
        return $this->{$field};
    }

    /**
     * Get normalized level key ('expert', 'advanced', 'intermediate', 'beginner').
     */
    public function getLevelKeyAttribute(): string
    {
        $val = strtolower((string) $this->proficiency);
        if (isset(self::LEVELS[$val])) {
            return $val;
        }

        // Backward compatibility for legacy numeric percentage values
        if (is_numeric($val)) {
            $num = (int) $val;
            if ($num >= 90) return 'expert';
            if ($num >= 80) return 'advanced';
            if ($num >= 60) return 'intermediate';
            return 'beginner';
        }

        return 'intermediate';
    }

    /**
     * Get localized human-readable level label.
     */
    public function getLevelLabelAttribute(): string
    {
        $key = $this->level_key;
        $locale = app()->getLocale();
        if ($locale === 'id') {
            return self::LEVELS[$key]['label_id'] ?? 'Menengah';
        }
        return self::LEVELS[$key]['label'] ?? 'Intermediate';
    }

    /**
     * Get styling badge class for the level.
     */
    public function getLevelBadgeClassAttribute(): string
    {
        $key = $this->level_key;
        return self::LEVELS[$key]['badge'] ?? 'bg-stone-100 text-stone-700 border-stone-200';
    }

    /**
     * Get styling accent dot class for the level.
     */
    public function getLevelDotClassAttribute(): string
    {
        $key = $this->level_key;
        return self::LEVELS[$key]['dot'] ?? 'bg-stone-400';
    }
}
