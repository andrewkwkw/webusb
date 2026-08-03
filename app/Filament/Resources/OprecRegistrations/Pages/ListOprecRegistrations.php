<?php

namespace App\Filament\Resources\OprecRegistrations\Pages;

use App\Filament\Resources\OprecRegistrations\OprecRegistrationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOprecRegistrations extends ListRecords
{
    protected static string $resource = OprecRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
