<?php

namespace App\Filament\Resources\Teachers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class TeacherForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('surname')
                    ->label('Фамилия')
                    ->placeholder('Например: Иванов')
                    ->maxLength(255)
                    ->required(),
                TextInput::make('name')
                    ->label('Имя')
                    ->placeholder('Например: Иван')
                    ->maxLength(255)
                    ->required(),
                TextInput::make('patronymic')
                    ->label('Отчество')
                    ->placeholder('Например: Иванович')
                    ->maxLength(255),
                TextInput::make('job_title')
                    ->label('Должность')
                    ->placeholder('Например: Председатель цикловой комиссии')
                    ->maxLength(255)
                    ->required(),
                TextInput::make('cabinet')
                    ->label('Номер кабинета')
                    ->placeholder('Например: 1311')
                    ->numeric(1)
                    ->maxLength(1319)
                    ->unique(ignoreRecord: true),
                TextInput::make('phone')
                    ->label('Телефон')
                    ->extraInputAttributes(['inputmode' => 'tel'])
                    ->prefixIcon('heroicon-o-phone')
                    ->mask('+7 (999) 999-99-99')
                    ->placeholder('+7 (843) 203-55-55')
                    ->maxLength(20)
                    ->dehydrateStateUsing(fn ($state) => preg_replace('/\D/', '', $state))
                    ->rules([
                        fn () => function (string $attribute, $value, \Closure $fail) {
                            $digits = preg_replace('/\D/', '', $value);
                            if (strlen($digits) !== 11) {
                                $fail('Номер должен содержать 11 цифр.');
                            }
                        },
                    ]),
                TextInput::make('extension_phone')
                    ->label('Добавочный номер')
                    ->placeholder('Например: 332')
                    ->numeric(1)
                    ->maxLength(999)
                    ->unique(ignoreRecord: true),
                TextInput::make('email')
                    ->label('Электронная почта')
                    ->email()
                    ->placeholder('example@mail.ru')
                    ->unique(ignoreRecord: true)
                    ->required()
                    ->maxLength(255),
                FileUpload::make('image')
                    ->label('Фотография')
                    ->image()
                    ->disk('public')
                    ->directory('teachers')
                    ->visibility('public')
                    ->openable()
                    ->downloadable()
                    ->previewable(true)
                    ->fetchFileInformation(false)
                    ->imagePreviewHeight('180')
                    ->maxSize(3072)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/svg+xml', 'image/webp'])
                    ->getUploadedFileNameForStorageUsing(function ($file): string {
                        $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                        $ext  = $file->getClientOriginalExtension();
                        $slug = \Illuminate\Support\Str::slug($name, '_');
                        return $slug . '_' . \Illuminate\Support\Str::random(8) . '.' . $ext;
                    })
                    ->helperText('JPG, PNG, SVG или WebP. Максимум 3 МБ. Чтобы заменить — нажмите × на превью и загрузите новое.')
                    ->validationMessages([
                        'mimetypes' => 'Разрешены только изображения (JPG, PNG, SVG, WebP).',
                        'max'       => 'Максимальный размер файла — 3 МБ.',
                    ]),
            ]);
    }
}
