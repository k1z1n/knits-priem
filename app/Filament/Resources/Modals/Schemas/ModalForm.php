<?php

namespace App\Filament\Resources\Modals\Schemas;

use App\Models\Modal;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ModalForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('type')
                    ->label('Тип модального окна')
                    ->options(Modal::TYPES)
                    ->default(Modal::TYPE_CUSTOM)
                    ->native(false)
                    ->required()
                    ->live()
                    ->helperText(function ($state) {
                        if ($state === Modal::TYPE_COUNTDOWN_DEADLINE) {
                            return 'Обратный отсчёт. Можно использовать плейсхолдеры в описании: '
                                . '{days_budget}, {budget_word}, {days_commerce}, {commerce_word}. '
                                . 'Числа дней подставляются автоматически из дат приёма документов.';
                        }
                        return 'Обычное модальное окно с произвольным текстом.';
                    }),

                TextInput::make('title')
                    ->label('Название')
                    ->placeholder('Например: Не упустите дедлайн')
                    ->maxLength(255)
                    ->required()
                    ->validationMessages([
                        'required' => 'Укажите название.',
                        'max' => 'Название слишком длинное (максимум :255 символов).',
                    ]),

                Textarea::make('description')
                    ->label('Описание')
                    ->placeholder(function ($get) {
                        return $get('type') === Modal::TYPE_COUNTDOWN_DEADLINE
                            ? "Например: До конца приёма документов на бюджет осталось {days_budget} {budget_word}, на коммерцию — {days_commerce} {commerce_word}."
                            : 'Текст, который будет показан в модальном окне';
                    })
                    ->rows(5)
                    ->required()
                    ->validationMessages([
                        'required' => 'Укажите описание.',
                    ]),

                TextInput::make('delay_seconds')
                    ->label('Таймкод (секунд)')
                    ->helperText('Через сколько секунд после загрузки страницы показать модальное окно. 0 — сразу.')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(86400)
                    ->default(0)
                    ->required()
                    ->validationMessages([
                        'required' => 'Укажите таймкод.',
                        'min' => 'Значение не может быть отрицательным.',
                        'max' => 'Значение слишком большое.',
                    ]),

                Toggle::make('is_active')
                    ->label('Активно')
                    ->helperText('Показывать модальное окно на сайте')
                    ->default(true),
            ]);
    }
}
