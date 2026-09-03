<?php

namespace App\Filament\Resources\PageHeroes;

use App\Filament\Resources\PageHeroes\Pages\ManagePageHeroes;
use App\Models\PageHero;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PageHeroResource extends Resource
{
    protected static ?string $model = PageHero::class;
    protected static string|\UnitEnum|null $navigationGroup = 'Pengaturan Website';
    protected static ?string $modelLabel = 'Banner Halaman';
    protected static ?string $pluralModelLabel = 'Banner Halaman';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-photo';

    protected static ?string $recordTitleAttribute = 'page_name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('page_name')
                    ->required(),
                FileUpload::make('image_path')
                    ->label('Gambar Utama (1)')
                    ->image()
                    ->disk('public')
                    ->directory('hero-images'),
                FileUpload::make('image_path_2')
                    ->label('Gambar Kedua (2)')
                    ->image()
                    ->disk('public')
                    ->directory('hero-images'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('page_name')
            ->columns([
                TextColumn::make('page_name')
                    ->label('Halaman')
                    ->searchable(),
                \Filament\Tables\Columns\IconColumn::make('has_hero')
                    ->label('Status')
                    ->boolean()
                    ->getStateUsing(fn ($record): bool => !empty($record->image_path))
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray'),
                ImageColumn::make('image_path')
                    ->label('Thumbnail')
                    ->disk('public')
                    ->circular(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                // 
            ]);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => ManagePageHeroes::route('/'),
        ];
    }
}
