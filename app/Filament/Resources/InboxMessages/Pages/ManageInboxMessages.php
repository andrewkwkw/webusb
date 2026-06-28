<?php

namespace App\Filament\Resources\InboxMessages\Pages;

use App\Filament\Resources\InboxMessages\InboxMessageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageInboxMessages extends ManageRecords
{
    protected static string $resource = InboxMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
