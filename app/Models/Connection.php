<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    protected $fillable = [
        'title',
        'value',
    ];

    public static function get(string $title, ?string $default = null): ?string
    {
        return static::query()->where('title', $title)->value('value') ?? $default;
    }
}
