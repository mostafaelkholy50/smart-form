<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = [
        'title',
        'description',
        'icon_class',
        'order',
        'is_active',
        'page_id',
    ];

    public $translatable = ['title', 'description'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
