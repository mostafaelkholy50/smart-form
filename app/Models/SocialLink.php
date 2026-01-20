<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    protected $fillable = ['platform', 'url', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get active social links
     */
    public static function getActive()
    {
        return self::where('is_active', true)->get();
    }
}
