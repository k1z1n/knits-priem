<?php

namespace App\Filament\Resources\Departments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DepartmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Название')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                TextColumn::make('head')
                    ->label('Заведующий(ая)')
                    ->formatStateUsing(
                        fn ($record) => $record->head
                            ? trim("{$record->head->surname} {$record->head->name} {$record->head->patronymic}")
                            : '—'
                    )
                    ->searchable(query: function ($query, string $search) {
                        $query->whereHas('head', function ($q) use ($search) {
                            $q->where('surname', 'like', "%{$search}%")
                                ->orWhere('name', 'like', "%{$search}%")
                                ->orWhere('patronymic', 'like', "%{$search}%");
                        });
                    }),

                IconColumn::make('is_universal')
                    ->label('Универсальное')
                    ->boolean()
                    ->tooltip(fn ($record) => $record->is_universal
                        ? 'Заведующий показывается на всех специальностях'
                        : 'Только на профильных специальностях'),

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
            ->defaultSort('title', 'asc')
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
            ->emptyStateHeading('Отделений пока нет')
            ->emptyStateDescription('Нажмите кнопку выше, чтобы добавить первое отделение.');
    }
}
