<?php

namespace App\Filament\Resources\Connections\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ConnectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Название настройки')
                    ->helperText('Уникальное название настройки. Например: «Заголовок баннера», «Подзаголовок баннера».')
                    ->placeholder('Заголовок баннера')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->validationMessages([
                        'unique'   => 'Настройка с таким ключом уже существует.',
                        'required' => 'Укажите ключ настройки.',
                        'max'      => 'Ключ слишком длинный (максимум :max символов).',
                    ]),

                Textarea::make('value')
                    ->label('Значение')
                    ->helperText('Текст, который будет показываться на сайте.')
                    ->placeholder('Приемная комиссия')
                    ->required()
                    ->rows(3)
                    ->maxLength(1000)
                    ->validationMessages([
                        'required' => 'Укажите значение.',
                        'max'      => 'Значение слишком длинное (максимум :max символов).',
                    ]),
            ]);
    }
}
