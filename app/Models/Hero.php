<?php

namespace App\Models;

use App\Models\Concerns\HasLocalisedFields;
use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    use HasLocalisedFields;

    protected $fillable = [
        'title',
        'title_ja',
        'button_cta',
        'button_cta_ja',
        'image_path'
    ];

    public static function getActive()
    {
        return self::latest()->first();
    }
}