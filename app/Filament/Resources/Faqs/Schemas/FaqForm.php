<?php

namespace App\Filament\Resources\Faqs\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('question')
                    ->label('Вопрос')
                    ->placeholder('Например: Какие документы необходимы при подаче заявления?')
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->validationMessages([
                        'unique' => 'Данный вопрос уже существует.',
                        'required' => 'Укажите вопрос.',
                        'max' => 'Вопрос слишком длинный (максимум :255 символов).',
                    ])
                    ->required(),
                Textarea::make('answer')
                    ->label('Ответ')
                    ->placeholder('Например: Всю информацию об этом можно посмотреть подробно на странице')
                    ->rows(4)
                    ->unique(ignoreRecord: true)
                    ->required(),
            ]);
    }
}
