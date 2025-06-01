<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class News extends Model
{
    protected $fillable = [
        'title',
        'content',
        'cta',
        'image_path',
        'posted_on'
    ];

    // Use casts instead of $dates
    protected $casts = [
        'posted_on' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function getTimeAgoAttribute()
    {
        return Carbon::parse($this->posted_on)->diffForHumans();
    }

    public static function getLatestNews($limit = 4)
    {
        return self::latest('posted_on')->take($limit)->get();
    }

    public function getExcerpt($length = 150)
    {
        return \Str::limit(strip_tags($this->content), $length);
    }
}