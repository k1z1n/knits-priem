<?php

namespace App\Filament\Resources\AnnouncementBars;

use App\Filament\Resources\AnnouncementBars\Pages\CreateAnnouncementBar;
use App\Filament\Resources\AnnouncementBars\Pages\EditAnnouncementBar;
use App\Filament\Resources\AnnouncementBars\Pages\ListAnnouncementBars;
use App\Filament\Resources\AnnouncementBars\Schemas\AnnouncementBarForm;
use App\Filament\Resources\AnnouncementBars\Tables\AnnouncementBarsTable;
use App\Models\AnnouncementBar;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AnnouncementBarResource extends Resource
{
    protected static ?string $model = AnnouncementBar::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMegaphone;

    protected static ?string $navigationLabel = 'Плашка-объявление';

    protected static ?string $pluralModelLabel = 'Плашки-объявления';
    protected static ?string $modelLabel = 'Плашка-объявление';
    protected static ?string $recordTitleAttribute = 'text';

    public static function form(Schema $schema): Schema
    {
        return AnnouncementBarForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AnnouncementBarsTable::configure($table);
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
            'index' => ListAnnouncementBars::route('/'),
            'create' => CreateAnnouncementBar::route('/create'),
            'edit' => EditAnnouncementBar::route('/{record}/edit'),
        ];
    }
}
