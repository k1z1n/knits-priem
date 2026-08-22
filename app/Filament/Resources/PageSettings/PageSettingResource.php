<?php

namespace App\Filament\Resources\PageSettings;

use App\Filament\Resources\PageSettings\Pages\ListPageSettings;
use App\Filament\Resources\PageSettings\Tables\PageSettingsTable;
use App\Models\PageSetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class PageSettingResource extends Resource
{
    protected static ?string $model = PageSetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEyeSlash;

    protected static ?string $navigationLabel = 'Страницы сайта';

    protected static ?string $modelLabel = 'Страница';
    protected static ?string $pluralModelLabel = 'Страницы сайта';
    protected static ?string $recordTitleAttribute = 'label';

    protected static ?int $navigationSort = 99;

    public static function table(Table $table): Table
    {
        return PageSettingsTable::configure($table);
    }

    /**
     * Набор страниц задаётся миграциями — из админки их только включают
     * и выключают, но не создают и не удаляют.
     */
    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPageSettings::route('/'),
        ];
    }
}
