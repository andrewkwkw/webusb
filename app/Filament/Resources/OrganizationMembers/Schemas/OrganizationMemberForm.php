<?php

namespace App\Filament\Resources\OrganizationMembers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrganizationMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('position')
                    ->required(),
                TextInput::make('department'),
                FileUpload::make('image_path')
                    ->image(),
                TextInput::make('order_column')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
