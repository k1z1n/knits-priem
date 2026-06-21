<?php

namespace App\Filament\Resources\CycleCommissions\Pages;

use App\Filament\Resources\CycleCommissions\CycleCommissionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCycleCommission extends CreateRecord
{
    protected static string $resource = CycleCommissionResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
