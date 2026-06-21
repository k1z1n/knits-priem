<?php

namespace App\Filament\Resources\Commissions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CommissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('address')
                ->label('Адрес')
                ->placeholder('Например: г. Казань, ул. Бари Галеева 3а')
                ->required()
                ->minLength(5)
                ->maxLength(255),

            TextInput::make('phone')
                ->label('Телефон')
                ->extraInputAttributes(['inputmode' => 'tel'])
                ->prefixIcon('heroicon-o-phone')
                ->mask('+7 (999) 999-99-99')
                ->placeholder('+7 (843) 203-55-55')
                ->required()
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
                ->extraInputAttributes(['inputmode' => 'numeric'])
                ->prefixIcon('heroicon-o-hashtag')
                ->placeholder('Например: 123'),

            TextInput::make('email')
                ->label('Электронная почта')
                ->email()
                ->placeholder('example@mail.ru')
                ->required()
                ->maxLength(255),

            DatePicker::make('budget_from')
                ->label('Срок подачи бюджета: с')
                ->required()
                ->native(false)
                ->displayFormat('d.m.Y')
                ->prefixIcon('heroicon-o-calendar'),

            DatePicker::make('budget_to')
                ->label('Срок подачи бюджета: по')
                ->required()
                ->native(false)
                ->displayFormat('d.m.Y')
                ->prefixIcon('heroicon-o-calendar')
                ->afterOrEqual('budget_from'),

            DatePicker::make('commerce_from')
                ->label('Срок подачи коммерческого предложения: с')
                ->required()
                ->native(false)
                ->displayFormat('d.m.Y')
                ->prefixIcon('heroicon-o-calendar'),

            DatePicker::make('commerce_to')
                ->label('Срок подачи коммерческого предложения: по')
                ->required()
                ->native(false)
                ->displayFormat('d.m.Y')
                ->prefixIcon('heroicon-o-calendar')
                ->afterOrEqual('commerce_from'),

            TextInput::make('route')
                ->label('Маршрут')
                ->placeholder('Например: «Советская площадь» — автобусы 1, 4')
                ->required()
                ->minLength(3)
                ->maxLength(255),

            Repeater::make('schedule')
                ->label('Режим работы')
                ->schema([
                    TextInput::make('days')
                        ->label('Дни')
                        ->placeholder('Например: Понедельник — четверг')
                        ->required()
                        ->maxLength(100),

                    Toggle::make('is_off')
                        ->label('Выходной')
                        ->default(false)
                        ->live(),

                    TimePicker::make('time_from')
                        ->label('Время с')
                        ->seconds(false)
                        ->displayFormat('H:i')
                        ->native(false)
                        ->required(fn (callable $get) => ! $get('is_off'))
                        ->hidden(fn (callable $get) => (bool) $get('is_off')),

                    TimePicker::make('time_to')
                        ->label('Время по')
                        ->seconds(false)
                        ->displayFormat('H:i')
                        ->native(false)
                        ->required(fn (callable $get) => ! $get('is_off'))
                        ->hidden(fn (callable $get) => (bool) $get('is_off')),
                ])
                ->columns(2)
                ->reorderable()
                ->collapsible()
                ->itemLabel(fn (array $state): ?string => $state['days'] ?? null)
                ->addActionLabel('Добавить строку расписания')
                ->defaultItems(0),
        ]);
    }
}
