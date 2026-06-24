<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Specialty extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'qualification',
        'code',
        'cycle_commission_id',
        'department_id',
        'budget_places',
        'commercial_places',
        'price_per_year',
        'duration',
        'study_form',
        'description_title',
        'description',
        'stacks',
        'skills',
        'careers',
        'core_subjects',
        'image',
        'specialty_document',
        'is_active',
        'sort_order',
    ];
    protected $casts = [
        'stacks'        => 'array',
        'skills'        => 'array',
        'careers'       => 'array',
        'core_subjects' => 'array',
        'is_active'     => 'boolean',
    ];

    protected static function booted(): void
    {
        // Если слаг не задан вручную — генерируем его из названия
        static::saving(function (Specialty $specialty) {
            if (blank($specialty->slug) && filled($specialty->title)) {
                $specialty->slug = static::generateUniqueSlug($specialty->title, $specialty->getKey());
            }
        });
    }

    /**
     * Сгенерировать уникальный слаг на основе названия.
     */
    public static function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title) ?: 'speciality';
        $slug = $base;
        $i = 2;

        while (
            static::query()
                ->where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->whereKeyNot($ignoreId))
                ->exists()
        ) {
            $slug = $base . '-' . $i;
            $i++;
        }

        return $slug;
    }

    /**
     * Привязка маршрута идёт по слагу: /speciality/{slug}.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
    protected function studyFormLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => match ($this->study_form) {
                'full_time' => 'Очная',
                'online'    => 'Онлайн (с применением дистанционных технологий)',
                default     => $this->study_form,
            },
        );
    }
    public function cycleCommission(): BelongsTo
    {
        return $this->belongsTo(CycleCommission::class);
    }
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
