<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'title_id',
        'tagline',
        'tagline_id',
        'bio',
        'bio_id',
        'short_bio',
        'avatar',
        'location',
        'email',
        'phone',
        'github_url',
        'linkedin_url',
        'website_url',
        'twitter_url',
        'resume_url',
        'availability_status',
        'years_of_experience',
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
     * Convert any Google Drive share link into a direct high-res image URL.
     */
    public static function convertGoogleDriveUrl(?string $url): ?string
    {
        if (empty($url)) {
            return $url;
        }

        $trimmed = trim($url);

        // Matches various Google Drive share link patterns:
        // - https://drive.google.com/file/d/{FILE_ID}/view?usp=sharing
        // - https://drive.google.com/file/d/{FILE_ID}/view
        // - https://drive.google.com/file/d/{FILE_ID}
        // - https://drive.google.com/open?id={FILE_ID}
        // - https://drive.google.com/uc?id={FILE_ID}
        // - https://lh3.googleusercontent.com/d/{FILE_ID}
        if (preg_match('/(?:drive\.google\.com\/(?:file\/d\/|open\?(?:.*&)?id=|uc\?(?:.*&)?id=)|lh3\.googleusercontent\.com\/d\/)([a-zA-Z0-9_-]+)/i', $trimmed, $matches)) {
            $fileId = $matches[1];
            return "https://lh3.googleusercontent.com/d/{$fileId}";
        }

        return $trimmed;
    }

    /**
     * Accessor: Ensures avatar always outputs direct embeddable URL even if raw Google Drive link was stored.
     */
    public function getAvatarAttribute(?string $value): ?string
    {
        return self::convertGoogleDriveUrl($value);
    }

    /**
     * Mutator: Automatically transforms Google Drive share links upon saving.
     */
    public function setAvatarAttribute(?string $value): void
    {
        $this->attributes['avatar'] = self::convertGoogleDriveUrl($value);
    }
}
