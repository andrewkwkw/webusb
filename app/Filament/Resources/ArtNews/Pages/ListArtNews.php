<?php

namespace App\Filament\Resources\ArtNews\Pages;

use App\Filament\Resources\ArtNews\ArtNewsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListArtNews extends ListRecords
{
    protected static string $resource = ArtNewsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
