<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DressCodeItem extends Model
{
    public const GROUP_MALE = 'male';
    public const GROUP_FEMALE = 'female';

    public const GROUPS = [
        self::GROUP_MALE => 'Для юношей',
        self::GROUP_FEMALE => 'Для девушек',
    ];

    protected $fillable = [
        'group',
        'text',
        'note',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function getGroupLabelAttribute(): string
    {
        return self::GROUPS[$this->group] ?? $this->group;
    }
}
