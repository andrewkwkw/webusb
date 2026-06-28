<?php

namespace App\Filament\Resources\CulturalExplorations\Pages;

use App\Filament\Resources\CulturalExplorations\CulturalExplorationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCulturalExplorations extends ListRecords
{
    protected static string $resource = CulturalExplorationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
