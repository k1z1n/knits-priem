<?php

namespace App\Filament\Resources\Specialties\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class SpecialtiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('')
                    ->disk('public')
                    ->square()
                    ->size(50)
                    ->toggleable(),

                TextColumn::make('code')
                    ->label('Код')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->fontFamily('mono'),

                TextColumn::make('title')
                    ->label('Название')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->limit(60)
                    ->tooltip(fn ($state) => $state),

                TextColumn::make('qualification')
                    ->label('Квалификация')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->limit(60)
                    ->placeholder('—')
                    ->tooltip(fn ($state) => $state)
                    ->toggleable(),

                TextColumn::make('cycleCommission.title')
                    ->label('Цикловая комиссия')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info')
                    ->toggleable(),

                TextColumn::make('department.title')
                    ->label('Отделение')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('success')
                    ->placeholder('—')
                    ->toggleable(),

                TextColumn::make('budget_places')
                    ->label('Бюджет')
                    ->numeric()
                    ->alignCenter()
                    ->sortable(),

                TextColumn::make('commercial_places')
                    ->label('Коммерция')
                    ->numeric()
                    ->alignCenter()
                    ->sortable(),

                TextColumn::make('price_per_year')
                    ->label('Стоимость')
                    ->money('RUB', divideBy: 1)
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('duration')
                    ->label('Длительность')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('study_form')
                    ->label('Форма')
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'full_time' => 'Очная',
                        'online'    => 'Онлайн',
                        default     => $state,
                    })
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'full_time' => 'primary',
                        'online'    => 'warning',
                        default     => 'gray',
                    })
                    ->toggleable(),

                TextColumn::make('specialty_document')
                    ->label('Документ')
                    ->icon('heroicon-o-document-text')
                    ->formatStateUsing(fn ($state) => $state ? basename($state) : '—')
                    ->placeholder('—')
                    ->limit(40)
                    ->tooltip(fn ($state) => $state ? basename($state) : null)
                    ->toggleable(),

                IconColumn::make('is_active')
                    ->label('Активна')
                    ->boolean()
                    ->sortable(),

                TextColumn::make('sort_order')
                    ->label('Порядок')
                    ->numeric()
                    ->alignCenter()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

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
            ->defaultSort('sort_order', 'asc')
            ->filters([
                SelectFilter::make('cycle_commission_id')
                    ->label('Цикловая комиссия')
                    ->relationship('cycleCommission', 'title')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('department_id')
                    ->label('Отделение')
                    ->relationship('department', 'title')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('study_form')
                    ->label('Форма обучения')
                    ->options([
                        'full_time' => 'Очная',
                        'online'    => 'Онлайн',
                    ]),

                TernaryFilter::make('is_active')
                    ->label('Активность')
                    ->trueLabel('Только активные')
                    ->falseLabel('Только скрытые')
                    ->placeholder('Все'),
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
            ->reorderable('sort_order')
            ->emptyStateHeading('Специальностей пока нет')
            ->emptyStateDescription('Нажмите кнопку выше, чтобы добавить первую специальность.');
    }
}
