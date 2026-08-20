<?php

namespace App\Support;

use App\Models\Job;
use App\Models\News;
use Illuminate\Support\Str;

/**
 * Shapes database records for the React layer.
 *
 * Editorial copy is NOT here — it lives in `lang/en/site.php` and
 * `lang/ja/site.php` and is shared with every Inertia response. This class
 * only handles admin-entered content, picking the Japanese field when the
 * visitor is reading Japanese and falling back to English when it is blank.
 */
class SiteContent
{
    /** Normalise a Job model for the React layer. */
    public static function jobCard(Job $job): array
    {
        return [
            'id' => $job->id,
            'title' => $job->localised('title'),
            'country' => $job->country,
            'positions' => $job->positions_left,
            'image' => $job->image_path ? asset('storage/'.$job->image_path) : null,
            'excerpt' => Str::limit(strip_tags((string) $job->localised('description')), 160),
            'postedOn' => optional($job->posted_on)->format('Y.m.d'),
            'url' => route('jobs.show', $job->id),
        ];
    }

    /** Normalise a News model for the React layer. */
    public static function newsCard(News $news): array
    {
        $image = $news->image_1 ?: $news->image_2;

        return [
            'id' => $news->id,
            'title' => $news->localised('title'),
            'excerpt' => Str::limit(strip_tags((string) $news->localised('content')), 160),
            'image' => $image ? asset('storage/'.$image) : null,
            'postedOn' => optional($news->posted_on)->format('Y.m.d'),
            'postedOnLong' => optional($news->posted_on)->translatedFormat('F j, Y'),
            'url' => route('news.read', $news->id),
        ];
    }
}
