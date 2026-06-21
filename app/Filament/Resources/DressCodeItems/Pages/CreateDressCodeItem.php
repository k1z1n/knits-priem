<?php

namespace App\Filament\Resources\DressCodeItems\Pages;

use App\Filament\Resources\DressCodeItems\DressCodeItemResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDressCodeItem extends CreateRecord
{
    protected static string $resource = DressCodeItemResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
