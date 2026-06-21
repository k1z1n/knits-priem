<?php

namespace App\Filament\Resources\CycleCommissions;

use App\Filament\Resources\CycleCommissions\Pages\CreateCycleCommission;
use App\Filament\Resources\CycleCommissions\Pages\EditCycleCommission;
use App\Filament\Resources\CycleCommissions\Pages\ListCycleCommissions;
use App\Filament\Resources\CycleCommissions\Schemas\CycleCommissionForm;
use App\Filament\Resources\CycleCommissions\Tables\CycleCommissionsTable;
use App\Models\CycleCommission;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CycleCommissionResource extends Resource
{
    protected static ?string $model = CycleCommission::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Цикловые комиссии';

    protected static ?string $pluralModelLabel = 'Цикловая комиссия';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return CycleCommissionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CycleCommissionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCycleCommissions::route('/'),
            'create' => CreateCycleCommission::route('/create'),
            'edit' => EditCycleCommission::route('/{record}/edit'),
        ];
    }
}
