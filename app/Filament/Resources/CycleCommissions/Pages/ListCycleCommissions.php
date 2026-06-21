<?php

namespace App\Filament\Resources\CycleCommissions\Pages;

use App\Filament\Resources\CycleCommissions\CycleCommissionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCycleCommissions extends ListRecords
{
    protected static string $resource = CycleCommissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
