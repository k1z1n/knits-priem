<?php

namespace App\Filament\Resources\DressCodeItems\Tables;

use App\Models\DressCodeItem;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class DressCodeItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('group')
                    ->label('Группа')
                    ->badge()
                    ->formatStateUsing(fn ($state) => DressCodeItem::GROUPS[$state] ?? $state)
                    ->color(fn ($state) => $state === DressCodeItem::GROUP_MALE ? 'info' : 'warning')
                    ->sortable(),

                TextColumn::make('text')
                    ->label('Текст пункта')
                    ->searchable()
                    ->wrap()
                    ->limit(100),

                TextColumn::make('note')
                    ->label('Примечание')
                    ->searchable()
                    ->wrap()
                    ->limit(80)
                    ->placeholder('—')
                    ->tooltip(fn ($state) => $state),

                TextColumn::make('sort_order')
                    ->label('Порядок')
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
            ->defaultSort('group', 'asc')
            ->groups([])
            ->filters([
                SelectFilter::make('group')
                    ->label('Группа')
                    ->options(DressCodeItem::GROUPS),
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
            ->emptyStateHeading('Пунктов пока нет')
            ->emptyStateDescription('Нажмите кнопку выше, чтобы добавить первый пункт дресс-кода.');
    }
}
