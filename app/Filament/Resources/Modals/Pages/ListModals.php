<?php

namespace App\Filament\Resources\Modals\Pages;

use App\Filament\Resources\Modals\ModalResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListModals extends ListRecords
{
    protected static string $resource = ModalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
