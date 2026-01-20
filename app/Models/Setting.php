<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'type'];

    /**
     * Get a setting value by key
     */
    public static function get(string $key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Set a setting value
     */
    public static function set(string $key, $value, string $type = 'string'): void
    {
        self::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => $type]
        );
    }

    /**
     * Upload and save a file setting
     */
    public static function uploadFile(string $key, $file, string $directory = 'uploads'): ?string
    {
        if ($file) {
            $path = $file->store($directory, 'public');
            self::set($key, $path, 'file');
            return $path;
        }
        return null;
    }
}
