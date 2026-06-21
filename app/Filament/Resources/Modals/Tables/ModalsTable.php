<?php

namespace App\Filament\Resources\Modals\Tables;

use App\Models\Modal;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ModalsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type')
                    ->label('Тип')
                    ->badge()
                    ->formatStateUsing(fn ($state) => Modal::TYPES[$state] ?? $state)
                    ->color(fn ($state) => $state === Modal::TYPE_COUNTDOWN_DEADLINE ? 'warning' : 'info')
                    ->sortable(),

                TextColumn::make('title')
                    ->label('Название')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->limit(80),

                TextColumn::make('description')
                    ->label('Описание')
                    ->searchable()
                    ->wrap()
                    ->limit(120)
                    ->tooltip(fn ($state) => $state),

                TextColumn::make('delay_seconds')
                    ->label('Таймкод (сек)')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => $state . ' сек'),

                IconColumn::make('is_active')
                    ->label('Активно')
                    ->boolean()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Создано')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Обновлено')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Редактировать'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Удалить выбранные'),
                ]),
            ])
            ->emptyStateHeading('Модальных окон пока нет')
            ->emptyStateDescription('Нажмите кнопку выше, чтобы добавить первое модальное окно.');
    }
}
