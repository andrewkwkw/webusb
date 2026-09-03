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
                    \Filament\Schemas\Components\Group::make()->columnSpan(['default' => 1, 'md' => 2])->schema([
                        \Filament\Schemas\Components\Section::make('Informasi Karya')->schema([
                            TextInput::make('title')->label('Judul')->required(),
                            TextInput::make('slug')->label('Slug (URL)')->required(),
                            RichEditor::make('description')->label('Deskripsi Karya')->required()->columnSpanFull(),
                            FileUpload::make('images')->label('Gambar/Foto Karya')->multiple()->image()->maxSize(2048)->maxFiles(10)->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])->directory('artworks')->reorderable()->columnSpanFull(),
                        ]),
                    ]),
                    \Filament\Schemas\Components\Group::make()->columnSpan(['default' => 1, 'md' => 1])->schema([
                        \Filament\Schemas\Components\Section::make('Kategori & Pengaturan')->schema([
                            Select::make('category')->label('Kategori')->options([
                                'Fotografi' => 'Fotografi',
                                'Videografi' => 'Videografi',
                                'Photo Story' => 'Photo Story',
                                'Dokumenter Visual' => 'Dokumenter Visual',
                            ])->required(),
                            TextInput::make('creator_name')->label('Nama Kreator'),
                            TextInput::make('publication_year')->label('Tahun Publikasi'),
                            TextInput::make('video_url')->url()->label('URL Video (Opsional)'),
                            Toggle::make('is_featured')->label('Sorotan Utama')->inline(false)->hidden(fn () => auth()->user()->role === 'author'),
                            Toggle::make('is_published')->label('Terbitkan')->inline(false)->hidden(fn () => auth()->user()->role === 'author')->default(false),
                            Hidden::make('user_id')->default(fn () => auth()->id()),
                        ]),
                    ]),
            ])
            ->columns(['default' => 1, 'md' => 3]);
    }
}
