<?php

namespace App\Filament\Resources\Archives;

use App\Filament\Resources\Archives\Pages\CreateArchive;
use App\Filament\Resources\Archives\Pages\EditArchive;
use App\Filament\Resources\Archives\Pages\ListArchives;
use App\Filament\Resources\Archives\Schemas\ArchiveForm;
use App\Filament\Resources\Archives\Tables\ArchivesTable;
use App\Models\Archive;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ArchiveResource extends Resource
{
    protected static ?string $model = Archive::class;

    protected static string|\UnitEnum|null $navigationGroup = 'Media & Publikasi';
    protected static ?string $modelLabel = 'Arsip Kegiatan';
    protected static ?string $pluralModelLabel = 'Daftar Arsip Kegiatan';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-archive-box';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return ArchiveForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ArchivesTable::configure($table);
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
            'index' => ListArchives::route('/'),
            'create' => CreateArchive::route('/create'),
            'edit' => EditArchive::route('/{record}/edit'),
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
