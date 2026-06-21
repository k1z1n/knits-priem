<?php

namespace App\Filament\Resources\AdmissionDocuments;

use App\Filament\Resources\AdmissionDocuments\Pages\CreateAdmissionDocument;
use App\Filament\Resources\AdmissionDocuments\Pages\EditAdmissionDocument;
use App\Filament\Resources\AdmissionDocuments\Pages\ListAdmissionDocuments;
use App\Filament\Resources\AdmissionDocuments\Schemas\AdmissionDocumentForm;
use App\Filament\Resources\AdmissionDocuments\Tables\AdmissionDocumentsTable;
use App\Models\AdmissionDocument;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AdmissionDocumentResource extends Resource
{
    protected static ?string $model = AdmissionDocument::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Документы для подачи (Главная)';

    protected static ?string $pluralModelLabel = 'Документы для подачи';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return AdmissionDocumentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AdmissionDocumentsTable::configure($table);
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
            'index' => ListAdmissionDocuments::route('/'),
            'create' => CreateAdmissionDocument::route('/create'),
            'edit' => EditAdmissionDocument::route('/{record}/edit'),
        ];
    }
}
