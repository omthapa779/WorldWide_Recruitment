<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class News extends Model
{
   
    protected $fillable = [
        'title',
        'content', 
        'image_1', 
        'image_2', 
        'posted_on', 
        'status'
    ];

    protected $casts = [
        'posted_on' => 'datetime'
    ];

    public function getExcerpt($length = 150)
    {
        return \Str::limit(strip_tags($this->content), $length);
    }

    public function getTimeAgoAttribute()
    {
        return $this->posted_on ? $this->posted_on->diffForHumans() : '';
    }
}