<?php

namespace App\Filament\Resources\DressCodeItems\Schemas;

use App\Models\DressCodeItem;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DressCodeItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('group')
                    ->label('Группа')
                    ->options(DressCodeItem::GROUPS)
                    ->default(DressCodeItem::GROUP_MALE)
                    ->required()
                    ->native(false)
                    ->validationMessages([
                        'required' => 'Выберите группу.',
                    ]),

                Textarea::make('text')
                    ->label('Текст пункта')
                    ->placeholder('Например: Деловой классический костюм, классическая рубашка')
                    ->rows(2)
                    ->maxLength(500)
                    ->required()
                    ->validationMessages([
                        'required' => 'Укажите текст пункта.',
                        'max' => 'Текст слишком длинный (максимум :500 символов).',
                    ]),

                Textarea::make('note')
                    ->label('Примечание')
                    ->helperText('Необязательно. Будет показано в виде выделенного блока под пунктом.')
                    ->placeholder('Например: В летнее время допускается ...')
                    ->rows(3)
                    ->nullable(),

                TextInput::make('sort_order')
                    ->label('Порядок сортировки')
                    ->helperText('Чем меньше число, тем выше пункт в списке.')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(9999)
                    ->default(0)
                    ->required(),

                Toggle::make('is_active')
                    ->label('Активно')
                    ->helperText('Показывать пункт на сайте')
                    ->default(true),
            ]);
    }
}
