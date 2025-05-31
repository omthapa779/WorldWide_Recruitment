<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = [
        'title',
        'image_path'
    ];

    public static function getActive()
    {
        return self::latest()->first();
    }
}