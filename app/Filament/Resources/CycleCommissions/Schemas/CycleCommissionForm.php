<?php

namespace App\Filament\Resources\CycleCommissions\Schemas;

use App\Models\Teacher;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CycleCommissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Название')
                    ->placeholder('Например: Веб технологии')
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->required(),
                Select::make('chairman_id')
                    ->label('Председатель')
                    ->placeholder('Выберите преподавателя')
                    ->options(fn () => Teacher::query()
                        ->orderBy('surname')
                        ->orderBy('name')
                        ->get()
                        ->mapWithKeys(fn (Teacher $t) => [
                            $t->id => trim("{$t->surname} {$t->name} {$t->patronymic}"),
                        ])
                        ->all())
                    ->searchable()
                    ->preload()
                    ->native(false)
                    ->required(),
            ]);
    }
}
