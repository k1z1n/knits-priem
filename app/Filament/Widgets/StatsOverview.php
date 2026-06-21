<?php

namespace App\Filament\Widgets;

use App\Models\AdmissionDocument;
use App\Models\CycleCommission;
use App\Models\Department;
use App\Models\Document;
use App\Models\Faq;
use App\Models\Specialty;
use App\Models\Teacher;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected ?string $heading = 'Статистика сайта';

    protected ?string $description = 'Количество записей в основных разделах';

    protected static ?int $sort = -3;

    protected function getStats(): array
    {
        return [
            Stat::make('Специальности', Specialty::count())
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('primary'),

            Stat::make('Преподаватели', Teacher::count())
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),

            Stat::make('Цикловые комиссии', CycleCommission::count())
                ->descriptionIcon('heroicon-m-building-library')
                ->color('info'),

            Stat::make('Отделения', Department::count())
                ->descriptionIcon('heroicon-m-building-office-2')
                ->color('warning'),

            Stat::make('Нормативные документы', Document::count())
                ->descriptionIcon('heroicon-m-document-text')
                ->color('gray'),

            Stat::make('Документы приёма', AdmissionDocument::count())
                ->descriptionIcon('heroicon-m-clipboard-document-check')
                ->color('gray'),

            Stat::make('Вопросы FAQ', Faq::count())
                ->descriptionIcon('heroicon-m-question-mark-circle')
                ->color('primary'),
        ];
    }
}
