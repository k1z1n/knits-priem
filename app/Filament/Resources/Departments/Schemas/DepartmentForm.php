<?php

namespace App\Filament\Resources\Departments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DepartmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Название отделения')
                    ->placeholder('Например: Информационные технологии')
                    ->required()
                    ->minLength(3)
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),

                Select::make('head_id')
                    ->label('Заведующий(ая) отделением')
                    ->relationship(
                        name: 'head',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn ($query) => $query->orderBy('name'),
                    )
                    ->getOptionLabelFromRecordUsing(
                        fn ($record) => trim("{$record->surname} {$record->name} {$record->patronymic}")
                    )
                    ->searchable(['surname', 'name', 'patronymic'])
                    ->preload()
                    ->nullable()
                    ->placeholder('Не назначен'),

                Toggle::make('is_universal')
                    ->label('Показывать на всех специальностях')
                    ->helperText('Включите для отделения, заведующий которого должен отображаться на странице каждой специальности (например, заведующая 1 курсом).')
                    ->default(false),
            ]);
    }
}
