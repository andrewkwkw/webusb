<?php

namespace App\Filament\Resources\ArtNews\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Schema;

class ArtNewsForm
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
            'Berita Kampus' => 'Berita kampus',
            'Berita Seni' => 'Berita seni',
            'Agenda' => 'Agenda',
            'Festival' => 'Festival',
            'Pameran' => 'Pameran',
        ])
                    ->required(),
                DatePicker::make('event_date'),
                Toggle::make('is_highlight')
                    ->label('Jadikan Sorotan Utama (Highlight)')
                    ->hidden(fn () => auth()->user()->role === 'author'),
                Hidden::make('user_id')
                    ->default(fn () => auth()->id()),
                Toggle::make('is_published')
                    ->label('Terbitkan ke Publik (Publish)')
                    ->hidden(fn () => auth()->user()->role === 'author')
                    ->default(false),
            ]);
    }
}
