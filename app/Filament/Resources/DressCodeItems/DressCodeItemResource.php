<?php

namespace App\Filament\Resources\DressCodeItems;

use App\Filament\Resources\DressCodeItems\Pages\CreateDressCodeItem;
use App\Filament\Resources\DressCodeItems\Pages\EditDressCodeItem;
use App\Filament\Resources\DressCodeItems\Pages\ListDressCodeItems;
use App\Filament\Resources\DressCodeItems\Schemas\DressCodeItemForm;
use App\Filament\Resources\DressCodeItems\Tables\DressCodeItemsTable;
use App\Models\DressCodeItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DressCodeItemResource extends Resource
{
    protected static ?string $model = DressCodeItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSparkles;

    protected static ?string $navigationLabel = 'Дресс-код';

    protected static ?string $pluralModelLabel = 'Дресс-код';
    protected static ?string $modelLabel = 'Пункт дресс-кода';
    protected static ?string $recordTitleAttribute = 'text';

    public static function form(Schema $schema): Schema
    {
        return DressCodeItemForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DressCodeItemsTable::configure($table);
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
            'index' => ListDressCodeItems::route('/'),
            'create' => CreateDressCodeItem::route('/create'),
            'edit' => EditDressCodeItem::route('/{record}/edit'),
        ];
    }
}
