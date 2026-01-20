<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ContactMethod extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = [
        'title',
        'content',
        'icon_class',
        'order',
        'is_active',
    ];

    public $translatable = ['title', 'content'];
}
