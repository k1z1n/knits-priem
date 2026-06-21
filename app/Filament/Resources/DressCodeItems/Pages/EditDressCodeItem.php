<?php

namespace App\Filament\Resources\DressCodeItems\Pages;

use App\Filament\Resources\DressCodeItems\DressCodeItemResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDressCodeItem extends EditRecord
{
    protected static string $resource = DressCodeItemResource::class;

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
