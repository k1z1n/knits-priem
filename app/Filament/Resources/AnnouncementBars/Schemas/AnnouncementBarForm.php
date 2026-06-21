<?php

namespace App\Filament\Resources\AnnouncementBars\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AnnouncementBarForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('text')
                    ->label('Текст плашки')
                    ->placeholder('Например: До окончания приёма документов осталось {days} {word}. Для поступления необходимо подать оригинал аттестата (9 классов).')
                    ->helperText('Доступные плейсхолдеры: {days} — количество дней до дедлайна, {word} — склонённое «день/дня/дней».')
                    ->rows(4)
                    ->required()
                    ->validationMessages([
                        'required' => 'Укажите текст плашки.',
                    ]),

                DatePicker::make('deadline_date')
                    ->label('Дата окончания приёма')
                    ->helperText('Используется для расчёта количества дней в плейсхолдере {days}.')
                    ->native(false)
                    ->displayFormat('d.m.Y'),

                Toggle::make('is_active')
                    ->label('Показывать на сайте')
                    ->default(true),
            ]);
    }
}
