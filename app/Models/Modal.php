<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Modal extends Model
{
    public const TYPE_CUSTOM = 'custom';
    public const TYPE_COUNTDOWN_DEADLINE = 'countdown_deadline';

    public const TYPES = [
        self::TYPE_CUSTOM => 'Обычное окно',
        self::TYPE_COUNTDOWN_DEADLINE => 'Обратный отсчёт до окончания приёма',
    ];

    protected $fillable = [
        'type',
        'title',
        'description',
        'delay_seconds',
        'is_active',
    ];

    protected $casts = [
        'delay_seconds' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Render the description with placeholders replaced.
     *
     * Supported placeholders (for countdown_deadline type):
     *   {days_budget}   — оставшихся дней до окончания приёма на бюджет
     *   {days_commerce} — оставшихся дней до окончания приёма на коммерцию
     *   {budget_word}   — склонённое «день/дня/дней» для бюджета
     *   {commerce_word} — склонённое «день/дня/дней» для коммерции
     */
    public function renderDescription(?Commission $commission = null): string
    {
        $text = (string) $this->description;

        if ($this->type !== self::TYPE_COUNTDOWN_DEADLINE) {
            return e($text);
        }

        $commission ??= Commission::query()->first();

        $budgetDays = self::daysUntil($commission?->budget_to) ?? 0;
        $commerceDays = self::daysUntil($commission?->commerce_to) ?? 0;

        // Escape the admin-entered text first, then substitute placeholders with safe HTML.
        $escaped = e($text);

        return strtr($escaped, [
            '{days_budget}'   => '<span class="site-modal__count">' . $budgetDays . '</span>',
            '{days_commerce}' => '<span class="site-modal__count">' . $commerceDays . '</span>',
            '{budget_word}'   => '<span class="site-modal__word">' . self::pluralDays($budgetDays) . '</span>',
            '{commerce_word}' => '<span class="site-modal__word">' . self::pluralDays($commerceDays) . '</span>',
        ]);
    }

    private static function daysUntil($date): ?int
    {
        if (! $date) {
            return null;
        }
        $target = $date instanceof Carbon ? $date->copy() : Carbon::parse($date);
        $diff = Carbon::today()->diffInDays($target->startOfDay(), false);
        return max(0, (int) $diff);
    }

    private static function pluralDays(int $n): string
    {
        $mod10 = $n % 10;
        $mod100 = $n % 100;
        if ($mod10 === 1 && $mod100 !== 11) {
            return 'день';
        }
        if ($mod10 >= 2 && $mod10 <= 4 && ($mod100 < 12 || $mod100 > 14)) {
            return 'дня';
        }
        return 'дней';
    }
}
