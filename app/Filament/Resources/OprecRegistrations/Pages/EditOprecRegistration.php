<?php

namespace App\Filament\Resources\OprecRegistrations\Pages;

use App\Filament\Resources\OprecRegistrations\OprecRegistrationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOprecRegistration extends EditRecord
{
    protected static string $resource = OprecRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
