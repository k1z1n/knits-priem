<?php

namespace App\Filament\Resources\Modals;

use App\Filament\Resources\Modals\Pages\CreateModal;
use App\Filament\Resources\Modals\Pages\EditModal;
use App\Filament\Resources\Modals\Pages\ListModals;
use App\Filament\Resources\Modals\Schemas\ModalForm;
use App\Filament\Resources\Modals\Tables\ModalsTable;
use App\Models\Modal;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ModalResource extends Resource
{
    protected static ?string $model = Modal::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleBottomCenterText;

    protected static ?string $navigationLabel = 'Модальные окна';

    protected static ?string $pluralModelLabel = 'Модальные окна';
    protected static ?string $modelLabel = 'Модальное окно';
    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return ModalForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ModalsTable::configure($table);
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
            'index' => ListModals::route('/'),
            'create' => CreateModal::route('/create'),
            'edit' => EditModal::route('/{record}/edit'),
        ];
    }
}
