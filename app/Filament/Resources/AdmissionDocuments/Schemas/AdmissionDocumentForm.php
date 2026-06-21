<?php

namespace App\Filament\Resources\AdmissionDocuments\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class AdmissionDocumentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Название')
                    ->placeholder('Например: Паспорт')
                    ->maxLength(100)
                    ->required()
                    ->unique(ignoreRecord: true),

                Textarea::make('note')
                    ->label('Примечание')
                    ->placeholder('Например: оригинал + копия')
                    ->maxLength(255)
                    ->rows(2)
                    ->nullable(),
            ]);
    }
}
