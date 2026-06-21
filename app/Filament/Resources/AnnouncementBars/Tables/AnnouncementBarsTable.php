<?php

namespace App\Filament\Resources\AnnouncementBars\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AnnouncementBarsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('text')
                    ->label('Текст')
                    ->searchable()
                    ->wrap()
                    ->limit(120)
                    ->tooltip(fn ($state) => $state),

                TextColumn::make('deadline_date')
                    ->label('Дата окончания приёма')
                    ->date('d.m.Y')
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Активно')
                    ->boolean()
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Обновлено')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('id', 'desc')
            ->recordActions([
                EditAction::make()->label('Редактировать'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Удалить выбранные'),
                ]),
            ])
            ->emptyStateHeading('Плашек ещё нет')
            ->emptyStateDescription('Нажмите кнопку выше, чтобы создать плашку-объявление.');
    }
}
