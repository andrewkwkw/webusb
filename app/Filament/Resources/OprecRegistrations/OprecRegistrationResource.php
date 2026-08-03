<?php

namespace App\Filament\Resources\OprecRegistrations;

use App\Filament\Resources\OprecRegistrations\Pages\CreateOprecRegistration;
use App\Filament\Resources\OprecRegistrations\Pages\EditOprecRegistration;
use App\Filament\Resources\OprecRegistrations\Pages\ListOprecRegistrations;
use App\Filament\Resources\OprecRegistrations\Schemas\OprecRegistrationForm;
use App\Filament\Resources\OprecRegistrations\Tables\OprecRegistrationsTable;
use App\Models\OprecRegistration;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OprecRegistrationResource extends Resource
{
    protected static ?string $model = OprecRegistration::class;

    protected static string|\UnitEnum|null $navigationGroup = 'Pendaftaran & Interaksi';
    protected static ?string $modelLabel = 'Oprec';
    protected static ?string $pluralModelLabel = 'Oprec';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return OprecRegistrationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OprecRegistrationsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOprecRegistrations::route('/'),
            'create' => CreateOprecRegistration::route('/create'),
            'edit' => EditOprecRegistration::route('/{record}/edit'),
        ];
    }
}
