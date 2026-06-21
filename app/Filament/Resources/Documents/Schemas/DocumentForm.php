<?php

namespace App\Filament\Resources\Documents\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DocumentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Название')
                    ->placeholder('Например: Положение о приёмной комиссии 2026–2027')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                FileUpload::make('path')
                    ->label('Загрузите документ')
                    ->required()
                    ->acceptedFileTypes([
                        'application/pdf',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        'text/plain',
                    ])
                    ->maxSize(20480)
                    ->directory('documents')
                    ->disk('public')
                    ->downloadable()
                    ->openable()
                    ->helperText('Допустимые форматы: PDF, DOC, DOCX, TXT. Максимум 20 МБ.')
                    ->validationMessages([
                        'mimetypes' => 'Разрешены только файлы PDF, DOC, DOCX или TXT.',
                        'max' => 'Максимальный размер файла — 20 МБ.',
                        'required' => 'Выберите файл для загрузки.',
                    ]),
            ]);
    }
}
