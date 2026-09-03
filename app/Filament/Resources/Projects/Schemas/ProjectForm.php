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
                    \Filament\Schemas\Components\Group::make()->columnSpan(['default' => 1, 'md' => 2])->schema([
                        \Filament\Schemas\Components\Section::make('Informasi Project')->schema([
                            TextInput::make('title')->label('Judul')->required(),
                            TextInput::make('slug')->label('Slug (URL)')->required(),
                            RichEditor::make('description')->columnSpanFull()->label('Deskripsi Singkat'),
                            RichEditor::make('content')->required()->columnSpanFull()->label('Konten Detail'),
                        ]),
                    ]),
                    \Filament\Schemas\Components\Group::make()->columnSpan(['default' => 1, 'md' => 1])->schema([
                        \Filament\Schemas\Components\Section::make('Kategori & Media')->schema([
                            Select::make('category')->label('Kategori')->options([
                                'Company Profile' => 'Company profile',
                                'Dokumenter Budaya' => 'Dokumenter budaya',
                                'Kolaborasi' => 'Kolaborasi',
                                'Program Tahunan' => 'Program tahunan',
                                'Pameran' => 'Pameran',
                            ])->required(),
                            TextInput::make('video_embed_url')->url()->label('URL Video Embed (Opsional)'),
                            FileUpload::make('cover_image_path')->image()->label('Gambar Cover')->directory('projects'),
                            Toggle::make('is_coming_soon')->label('Label Coming Soon')->helperText('Tampilkan lencana Coming Soon pada proyek ini')->inline(false)->default(false),
                            Toggle::make('is_published')->label('Terbitkan')->inline(false)->default(false),
                            Hidden::make('user_id')->default(fn () => auth()->id()),
                        ]),
                    ]),
            ])
            ->columns(['default' => 1, 'md' => 3]);
    }
}
