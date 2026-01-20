<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = [
        'slug',
        'title',
        'is_active',
        'order',
    ];

    public $translatable = ['title', 'slug'];

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    /**
     * Get the route for the page.
     */
    public function getUrlAttribute()
    {
        return route('page.show', $this->slug);
    }
}
