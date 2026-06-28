<?php

namespace App\Filament\Resources\Archives\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Schema;

class ArchiveForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                Select::make('activity_type')
                    ->options([
            'Latihan Rutin' => 'Latihan rutin',
            'Workshop' => 'Workshop',
            'Kunjungan' => 'Kunjungan',
            'Event Internal' => 'Event internal',
            'Dokumentasi' => 'Dokumentasi',
        ])
                    ->required(),
                TextInput::make('year')
                    ->required(),
                FileUpload::make('document_path')
                    ->directory('archives'),
                Hidden::make('user_id')
                    ->default(fn () => auth()->id()),
            ]);
    }
}
