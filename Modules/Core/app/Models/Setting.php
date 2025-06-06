<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function get($key, $default = null)
    {
        return static::query()->where('key', $key)->value('value') ?? $default;
    }

    public static function set($key, $value)
    {
        return static::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    public static function getLogoUrl()
    {
        $logo = static::get('app::logo');
        if (filter_var($logo, FILTER_VALIDATE_URL)) {
            return $logo;
        }

        // check in the storage
        if ($logo && Storage::disk('public')->exists($logo)) {
            return asset(Storage::url($logo));
        }

        // default logo
        return asset('images/book.png');
    }
}
