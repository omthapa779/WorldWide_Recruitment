<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    protected $fillable = [
        'title',
        'button_cta',
        'image_path'
    ];

    public static function getActive()
    {
        return self::latest()->first();
    }
}