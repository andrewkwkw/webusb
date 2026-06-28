<?php

namespace App\Filament\Resources\CulturalExplorations\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Schema;

class CulturalExplorationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                RichEditor::make('content')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image_path')
                    ->image(),
                Select::make('category')
                    ->options([
            'Tradisi' => 'Tradisi',
            'Komunitas' => 'Komunitas',
            'Catatan Perjalanan' => 'Catatan perjalanan',
            'Liputan Budaya' => 'Liputan budaya',
        ])
                    ->required(),
                TextInput::make('location'),
                TagsInput::make('tags'),
                Hidden::make('user_id')
                    ->default(fn () => auth()->id()),
                Toggle::make('is_published')
                    ->label('Terbitkan ke Publik (Publish)')
                    ->hidden(fn () => auth()->user()->role === 'author')
                    ->default(false),
            ]);
    }
}
