<?php

namespace App\Filament\Resources\CulturalExplorations;

use App\Filament\Resources\CulturalExplorations\Pages\CreateCulturalExploration;
use App\Filament\Resources\CulturalExplorations\Pages\EditCulturalExploration;
use App\Filament\Resources\CulturalExplorations\Pages\ListCulturalExplorations;
use App\Filament\Resources\CulturalExplorations\Schemas\CulturalExplorationForm;
use App\Filament\Resources\CulturalExplorations\Tables\CulturalExplorationsTable;
use App\Models\CulturalExploration;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CulturalExplorationResource extends Resource
{
    protected static ?string $model = CulturalExploration::class;

    protected static string|\UnitEnum|null $navigationGroup = 'Media & Publikasi';
    protected static ?string $modelLabel = 'Telusur Budaya';
    protected static ?string $pluralModelLabel = 'Daftar Telusur Budaya';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-globe-asia-australia';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return CulturalExplorationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CulturalExplorationsTable::configure($table);
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
            'index' => ListCulturalExplorations::route('/'),
            'create' => CreateCulturalExploration::route('/create'),
            'edit' => EditCulturalExploration::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (auth()->check() && auth()->user()->role === 'author') {
            $query->where('user_id', auth()->id());
        }

        return $query;
    }
}
