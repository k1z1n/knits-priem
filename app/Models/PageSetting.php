<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSetting extends Model
{
    public const RATING = 'rating';

    protected $fillable = [
        'key',
        'label',
        'is_enabled',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
    ];

    /**
     * Если настройки в базе нет — страница считается включённой, чтобы новая
     * страница не пропала с сайта из-за неприменённой миграции.
     */
    public static function enabled(string $key, bool $default = true): bool
    {
        $value = static::query()->where('key', $key)->value('is_enabled');

        return $value === null ? $default : (bool) $value;
    }
}
