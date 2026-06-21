<?php

namespace App\Filament\Resources\Modals\Pages;

use App\Filament\Resources\Modals\ModalResource;
use Filament\Resources\Pages\CreateRecord;

class CreateModal extends CreateRecord
{
    protected static string $resource = ModalResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
