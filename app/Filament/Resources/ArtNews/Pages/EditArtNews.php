<?php

namespace App\Filament\Resources\ArtNews\Pages;

use App\Filament\Resources\ArtNews\ArtNewsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditArtNews extends EditRecord
{
    protected static string $resource = ArtNewsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
