<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Schema;

class ProjectForm
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
                    ->columnSpanFull(),
                RichEditor::make('content')
                    ->required()
                    ->columnSpanFull(),
                Select::make('category')
                    ->options([
            'Company Profile' => 'Company profile',
            'Dokumenter Budaya' => 'Dokumenter budaya',
            'Kolaborasi' => 'Kolaborasi',
            'Program Tahunan' => 'Program tahunan',
            'Pameran' => 'Pameran',
        ])
                    ->required(),
                TextInput::make('video_embed_url')
                    ->url(),
                FileUpload::make('cover_image_path')
                    ->image(),
                Hidden::make('user_id')
                    ->default(fn () => auth()->id()),
                Toggle::make('is_published')
                    ->required(),
            ]);
    }
}
