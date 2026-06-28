<?php

namespace App\Filament\Resources\Artworks\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Schema;

class ArtworkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                RichEditor::make('description')
                    ->required()
                    ->columnSpanFull(),
                Select::make('category')
                    ->options([
            'Fotografi' => 'Fotografi',
            'Videografi' => 'Videografi',
            'Photo Story' => 'Photo story',
            'Dokumenter Visual' => 'Dokumenter visual',
        ])
                    ->required(),
                FileUpload::make('images')
                    ->multiple()
                    ->image()
                    ->directory('artworks')
                    ->reorderable()
                    ->columnSpanFull(),
                TextInput::make('video_url')
                    ->url(),
                TextInput::make('publication_year'),
                TextInput::make('creator_name'),
                Toggle::make('is_featured')
                    ->label('Jadikan Sorotan Utama (Featured)')
                    ->hidden(fn () => auth()->user()->role === 'author'),
                Toggle::make('is_published')
                    ->label('Terbitkan ke Publik (Publish)')
                    ->hidden(fn () => auth()->user()->role === 'author')
                    ->default(false),
                Hidden::make('user_id')
                    ->default(fn () => auth()->id()),
            ]);
    }
}
