<?php

namespace App\Filament\Resources\ArtNews;

use App\Filament\Resources\ArtNews\Pages\CreateArtNews;
use App\Filament\Resources\ArtNews\Pages\EditArtNews;
use App\Filament\Resources\ArtNews\Pages\ListArtNews;
use App\Filament\Resources\ArtNews\Schemas\ArtNewsForm;
use App\Filament\Resources\ArtNews\Tables\ArtNewsTable;
use App\Models\ArtNews;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ArtNewsResource extends Resource
{
    protected static ?string $model = ArtNews::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-calendar-days';
    

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return ArtNewsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ArtNewsTable::configure($table);
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
            'index' => ListArtNews::route('/'),
            'create' => CreateArtNews::route('/create'),
            'edit' => EditArtNews::route('/{record}/edit'),
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
