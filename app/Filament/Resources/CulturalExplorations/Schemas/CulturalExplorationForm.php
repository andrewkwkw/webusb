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
                    \Filament\Schemas\Components\Group::make()->columnSpan(['default' => 1, 'md' => 2])->schema([
                        \Filament\Schemas\Components\Section::make('Konten Telusur Budaya')->schema([
                            TextInput::make('title')->label('Judul')->required(),
                            TextInput::make('slug')->label('Slug (URL)')->required(),
                            RichEditor::make('content')->label('Isi Konten')->required()->columnSpanFull(),
                        ]),
                    ]),
                    \Filament\Schemas\Components\Group::make()->columnSpan(['default' => 1, 'md' => 1])->schema([
                        \Filament\Schemas\Components\Section::make('Pengaturan & Media')->schema([
                            Select::make('category')->label('Kategori')->options([
                                'Tradisi' => 'Tradisi',
                                'Komunitas' => 'Komunitas',
                                'Catatan Perjalanan' => 'Catatan perjalanan',
                                'Liputan Budaya' => 'Liputan budaya',
                            ])->required(),
                            TextInput::make('location')->label('Lokasi'),
                            TagsInput::make('tags')->label('Tag'),
                            FileUpload::make('image_path')->image()->label('Thumbnail'),
                            Toggle::make('is_published')->label('Terbitkan')->inline(false)->hidden(fn () => auth()->user()->role === 'author')->default(false),
                            Hidden::make('user_id')->default(fn () => auth()->id()),
                        ]),
                    ]),
            ])
            ->columns(['default' => 1, 'md' => 3]);
    }
}
