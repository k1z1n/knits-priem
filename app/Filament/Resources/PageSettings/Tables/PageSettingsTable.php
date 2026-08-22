<?php

namespace App\Filament\Resources\PageSettings\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class PageSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('label')
                    ->label('Страница'),

                ToggleColumn::make('is_enabled')
                    ->label('Показывать на сайте'),

                TextColumn::make('updated_at')
                    ->label('Обновлено')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('label')
            ->paginated(false);
    }
}
