<?php

namespace App\Filament\Resources\AdmissionDocuments\Pages;

use App\Filament\Resources\AdmissionDocuments\AdmissionDocumentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAdmissionDocument extends EditRecord
{
    protected static string $resource = AdmissionDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
