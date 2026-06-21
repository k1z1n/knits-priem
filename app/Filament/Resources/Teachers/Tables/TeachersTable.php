<?php

namespace App\Filament\Resources\Teachers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;

class TeachersTable
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

                TextColumn::make('surname')
                    ->label('Фамилия')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Имя')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('patronymic')
                    ->label('Отчество')
                    ->searchable()
                    ->placeholder('—'),

                TextColumn::make('job_title')
                    ->label('Должность')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                TextColumn::make('cabinet')
                    ->label('Кабинет')
                    ->sortable()
                    ->placeholder('—'),

                TextColumn::make('phone')
                    ->label('Телефон')
                    ->icon('heroicon-o-phone')
                    ->formatStateUsing(function ($state) {
                        if (! $state) {
                            return '—';
                        }
                        $d = preg_replace('/\D/', '', $state);
                        if (strlen($d) === 11) {
                            return sprintf(
                                '+7 (%s) %s-%s-%s',
                                substr($d, 1, 3),
                                substr($d, 4, 3),
                                substr($d, 7, 2),
                                substr($d, 9, 2),
                            );
                        }
                        return $state;
                    })
                    ->searchable(),

                TextColumn::make('extension_phone')
                    ->label('Доб.')
                    ->placeholder('—')
                    ->toggleable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->icon('heroicon-o-envelope')
                    ->searchable()
                    ->copyable(),

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
            ->defaultSort('surname')
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
                        ->label('Удалить выбранных'),
                ]),
            ])
            ->emptyStateHeading('Преподавателей пока нет')
            ->emptyStateDescription('Нажмите кнопку выше, чтобы добавить первого преподавателя.');
    }
}
