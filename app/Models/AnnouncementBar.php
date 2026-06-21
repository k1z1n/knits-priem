<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class AnnouncementBar extends Model
{
    protected $fillable = [
        'text',
        'deadline_date',
        'is_active',
    ];

    protected $casts = [
        'deadline_date' => 'date',
        'is_active' => 'boolean',
    ];

    public static function active(): ?self
    {
        return self::query()
            ->where('is_active', true)
            ->orderByDesc('id')
            ->first();
    }

    public function renderText(): string
    {
        $days = $this->daysLeft();

        $escaped = e((string) $this->text);

        return strtr($escaped, [
            '{days}' => '<span class="announcement-bar__count">' . $days . '</span>',
            '{word}' => '<span class="announcement-bar__word">' . self::pluralDays($days) . '</span>',
            '{countdown}' => $this->renderCountdown(),
        ]);
    }

    protected function renderCountdown(): string
    {
        if (! $this->deadline_date) {
            return '';
        }

        $target = ($this->deadline_date instanceof Carbon
            ? $this->deadline_date->copy()
            : Carbon::parse($this->deadline_date))->endOfDay();

        $totalSeconds = max(0, $target->getTimestamp() - Carbon::now()->getTimestamp());
        $days = intdiv($totalSeconds, 86400);
        $hours = intdiv($totalSeconds % 86400, 3600);
        $minutes = intdiv($totalSeconds % 3600, 60);
        $seconds = $totalSeconds % 60;

        return sprintf(
            '<span class="announcement-bar__timer" data-deadline="%s">%d %s %02d:%02d:%02d</span>',
            e($target->toIso8601String()),
            $days,
            self::pluralDays($days),
            $hours,
            $minutes,
            $seconds
        );
    }

    public function daysLeft(): int
    {
        if (! $this->deadline_date) {
            return 0;
        }

        $target = $this->deadline_date instanceof Carbon
            ? $this->deadline_date->copy()
            : Carbon::parse($this->deadline_date);

        return max(0, (int) Carbon::today()->diffInDays($target->startOfDay(), false));
    }

    public static function pluralDays(int $n): string
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
