<?php

namespace App\Filament\Resources\CycleCommissions\Pages;

use App\Filament\Resources\CycleCommissions\CycleCommissionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCycleCommission extends EditRecord
{
    protected static string $resource = CycleCommissionResource::class;

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
