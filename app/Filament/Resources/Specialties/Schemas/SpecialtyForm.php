<?php

namespace App\Filament\Resources\Specialties\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;

class SpecialtyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Основная информация')
                ->description('Название специальности, код и принадлежность')
                ->columnSpanFull()
                ->columns(2)
                ->schema([
                    TextInput::make('title')
                        ->label('Название специальности')
                        ->placeholder('Например: Разработчик веб-приложений на стороне клиента')
                        ->required()
                        ->minLength(5)
                        ->maxLength(255)
                        ->columnSpanFull(),

                    TextInput::make('qualification')
                        ->label('Квалификация')
                        ->unique(ignoreRecord: true)
                        ->placeholder('Например: Специалист по компьютерным системам')
                        ->maxLength(255)
                        ->columnSpanFull(),

                    TextInput::make('code')
                        ->label('Код специальности')
                        ->placeholder('Например: 09.02.09')
                        ->required()
                        ->maxLength(10)
                        ->mask('99.99.99'),

                    Select::make('cycle_commission_id')
                        ->label('Цикловая комиссия')
                        ->relationship('cycleCommission', 'title')
                        ->searchable()
                        ->preload()
                        ->required()
                        ->placeholder('Выберите ЦК'),

                    Select::make('department_id')
                        ->label('Отделение')
                        ->relationship('department', 'title')
                        ->searchable()
                        ->preload()
                        ->nullable()
                        ->placeholder('Не привязано'),
                ]),
            Section::make('Места и стоимость')
                ->description('Количество мест и стоимость обучения')
                ->columnSpanFull()
                ->columns(3)
                ->schema([
                    TextInput::make('budget_places')
                        ->label('Бюджетных мест')
                        ->numeric()
                        ->maxValue(999)
                        ->required()
                        ->placeholder('25'),

                    TextInput::make('commercial_places')
                        ->label('Коммерческих мест')
                        ->numeric()
                        ->maxValue(999)
                        ->required()
                        ->placeholder('30'),

                    TextInput::make('price_per_year')
                        ->label('Стоимость за год обучения')
                        ->mask(RawJs::make("\$money(\$input, '.', ' ', 0)"))
                        ->stripCharacters(' ')
                        ->numeric()
                        ->minValue(0)
                        ->required()
                        ->placeholder('88 880')
                        ->suffix('₽'),
                ]),
            Section::make('Параметры обучения')
                ->columnSpanFull()
                ->columns(2)
                ->schema([
                    TextInput::make('duration')
                        ->label('Длительность обучения')
                        ->placeholder('Например: 2 г. 10 мес.')
                        ->required()
                        ->maxLength(50),

                    Select::make('study_form')
                        ->label('Форма обучения')
                        ->options([
                            'full_time' => 'Очная',
                            'online'    => 'Онлайн (с применением дистанционных технологий)',
                        ])
                        ->default('full_time')
                        ->required(),
                ]),
            Section::make('О программе')
                ->description('Описание специальности для страницы')
                ->columnSpanFull()
                ->schema([
                    Textarea::make('description_title')
                        ->label('Краткое описание (выводится крупно)')
                        ->placeholder('Готовим квалифицированных специалистов в области...')
                        ->required()
                        ->rows(3)
                        ->maxLength(500),

                    Textarea::make('description')
                        ->label('Основное описание')
                        ->placeholder('Программа сочетает теоретические знания и практические навыки...')
                        ->required()
                        ->rows(5)
                        ->maxLength(2000),

                    Repeater::make('stacks')
                        ->label('Технологии и направления')
                        ->schema([
                            TextInput::make('title')
                                ->label('Название')
                                ->required()
                                ->placeholder('Например: JavaScript')
                                ->maxLength(100),
                        ])
                        ->reorderable()
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                        ->addActionLabel('Добавить технологию')
                        ->defaultItems(0),
                ]),
            Section::make('Программа обучения')
                ->description('Что студент изучит и кем сможет работать')
                ->columnSpanFull()
                ->schema([
                    Repeater::make('skills')
                        ->label('Ты научишься')
                        ->schema([
                            Textarea::make('description')
                                ->label('Описание навыка')
                                ->required()
                                ->rows(3)
                                ->placeholder('Проектировать архитектуру веб-сайтов...')
                                ->maxLength(500),
                        ])
                        ->reorderable()
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string =>
                        isset($state['description'])
                            ? \Illuminate\Support\Str::limit($state['description'], 50)
                            : null
                        )
                        ->addActionLabel('Добавить навык')
                        ->defaultItems(0),

                    Repeater::make('careers')
                        ->label('Кем будешь работать')
                        ->schema([
                            TextInput::make('title')
                                ->label('Профессия / должность')
                                ->required()
                                ->placeholder('Например: web-программист')
                                ->maxLength(100),
                        ])
                        ->reorderable()
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                        ->addActionLabel('Добавить профессию')
                        ->defaultItems(0),

                    Repeater::make('core_subjects')
                        ->label('Профильные предметы')
                        ->schema([
                            TextInput::make('title')
                                ->label('Название предмета')
                                ->required()
                                ->placeholder('Например: Разработка кода информационных систем')
                                ->maxLength(255),
                        ])
                        ->reorderable()
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                        ->addActionLabel('Добавить предмет')
                        ->defaultItems(0),
                ]),
            Section::make('Иллюстрация')
                ->description('Картинка для hero-блока на странице специальности')
                ->columnSpanFull()
                ->schema([
                    FileUpload::make('image')
                        ->label('Изображение')
                        ->image()
                        ->disk('public')
                        ->directory('specialties')
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
                    FileUpload::make('specialty_document')
                        ->label('Загрузите документ')
                        ->acceptedFileTypes([
                            'application/pdf',
                            'application/msword',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            'text/plain',
                        ])
                        ->maxSize(20480)
                        ->directory('documents')
                        ->disk('public')
                        ->preserveFilenames()
                        ->downloadable()
                        ->openable()
                        ->helperText('Допустимые форматы: PDF, DOC, DOCX, TXT. Максимум 20 МБ.')
                        ->validationMessages([
                            'mimetypes' => 'Разрешены только файлы PDF, DOC, DOCX или TXT.',
                            'max' => 'Максимальный размер файла — 20 МБ.',
                            'required' => 'Выберите файл для загрузки.',
                        ]),
                ]),
            Section::make('Управление')
                ->description('Видимость на сайте и порядок отображения')
                ->columnSpanFull()
                ->columns(2)
                ->schema([
                    Toggle::make('is_active')
                        ->label('Активна')
                        ->helperText('Если выключено — специальность не показывается на сайте.')
                        ->default(true),

                    TextInput::make('sort_order')
                        ->label('Порядок отображения')
                        ->helperText('Чем меньше число, тем выше в списке.')
                        ->numeric()
                        ->default(0)
                        ->minValue(0)
                        ->maxValue(999),
                ]),
        ]);
    }
}
