<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeaderLink extends Model
{
    protected $fillable = [
        'label_ar',
        'label_en',
        'url',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get active links ordered by order column
     */
    public static function getActiveLinks()
    {
        return self::where('is_active', true)
            ->orderBy('order')
            ->get();
    }

    /**
     * Get label based on current locale
     */
    public function getLabel()
    {
        $locale = app()->getLocale();
        return $locale === 'ar' ? $this->label_ar : $this->label_en;
    }
}
