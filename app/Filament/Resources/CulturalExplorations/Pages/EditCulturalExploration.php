<?php

namespace App\Filament\Resources\CulturalExplorations\Pages;

use App\Filament\Resources\CulturalExplorations\CulturalExplorationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCulturalExploration extends EditRecord
{
    protected static string $resource = CulturalExplorationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
