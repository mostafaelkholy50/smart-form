<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HostingPlan extends Model
{
    use HasFactory;
    use \Spatie\Translatable\HasTranslations;

    protected $fillable = [
        'key',
        'name',
        'price',
        'currency',
        'features',
    ];

    public $translatable = ['name', 'currency'];

    protected $casts = [
        'features' => 'array',
    ];
    //
}
