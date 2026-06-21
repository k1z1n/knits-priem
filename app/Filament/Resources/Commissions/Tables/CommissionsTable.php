<?php

namespace App\Filament\Resources\Commissions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CommissionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('address')
                    ->label('Адрес')
                    ->searchable()
                    ->wrap()
                    ->limit(50),

                TextColumn::make('phone')
                    ->label('Телефон')
                    ->searchable()
                    ->icon('heroicon-o-phone')
                    ->formatStateUsing(function ($state) {
                        if (! $state) return null;
                        $digits = preg_replace('/\D/', '', $state);
                        if (strlen($digits) !== 11) return $state;
                        return sprintf(
                            '+%s (%s) %s-%s-%s',
                            $digits[0],
                            substr($digits, 1, 3),
                            substr($digits, 4, 3),
                            substr($digits, 7, 2),
                            substr($digits, 9, 2),
                        );
                    })
                    ->copyable()
                    ->copyMessage('Телефон скопирован'),

                TextColumn::make('extension_phone')
                    ->label('Добавочный номер')
                    ->searchable()
                    ->icon('heroicon-o-hashtag')
                    ->placeholder('—'),

                TextColumn::make('email')
                    ->label('Электронная почта')
                    ->searchable()
                    ->icon('heroicon-o-envelope')
                    ->copyable()
                    ->copyMessage('Email скопирован'),

                TextColumn::make('budget_from')
                    ->label('Бюджет: с')
                    ->date('d.m.Y')
                    ->sortable(),

                TextColumn::make('budget_to')
                    ->label('Бюджет: по')
                    ->date('d.m.Y')
                    ->sortable(),

                TextColumn::make('commerce_from')
                    ->label('Коммерция: с')
                    ->date('d.m.Y')
                    ->sortable(),

                TextColumn::make('commerce_to')
                    ->label('Коммерция: по')
                    ->date('d.m.Y')
                    ->sortable(),

                TextColumn::make('route')
                    ->label('Маршрут')
                    ->searchable()
                    ->icon('heroicon-o-map'),

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
            ->emptyStateHeading('Данные приёмной комиссии ещё не заполнены')
            ->emptyStateDescription('Нажмите кнопку выше, чтобы добавить запись.');
    }
}
