<?php

namespace App\Models;

use App\Models\Concerns\HasLocalisedFields;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Job extends Model
{
    use HasLocalisedFields;

     protected $fillable = [
    'title',
    'title_ja',
    'positions_left',
    'country',
    'description',
    'description_ja',
    'image_path',
    'is_featured',
    'featured_order',
    'posted_on'
    ];

    protected $casts = [
        'posted_on' => 'datetime',
        'is_featured' => 'boolean'
    ];

    public function getTimeAgoAttribute()
    {
        return Carbon::parse($this->posted_on)->diffForHumans();
    }

    public static function getFeaturedJobs($limit = 5)
    {
        return self::where('is_featured', 1)
            ->orderBy('featured_order') 
            ->take($limit)
            ->get();
    }
}