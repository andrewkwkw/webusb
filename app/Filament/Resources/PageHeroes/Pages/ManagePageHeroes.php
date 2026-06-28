<?php

namespace App\Filament\Resources\PageHeroes\Pages;

use App\Filament\Resources\PageHeroes\PageHeroResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManagePageHeroes extends ManageRecords
{
    protected static string $resource = PageHeroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
