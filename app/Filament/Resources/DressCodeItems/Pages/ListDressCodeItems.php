<?php

namespace App\Filament\Resources\DressCodeItems\Pages;

use App\Filament\Resources\DressCodeItems\DressCodeItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDressCodeItems extends ListRecords
{
    protected static string $resource = DressCodeItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
