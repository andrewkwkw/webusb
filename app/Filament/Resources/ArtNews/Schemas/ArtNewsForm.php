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
                    \Filament\Schemas\Components\Group::make()->columnSpan(['default' => 1, 'md' => 2])->schema([
                        \Filament\Schemas\Components\Section::make('Konten Berita')->schema([
                            TextInput::make('title')->label('Judul')->required(),
                            TextInput::make('slug')->label('Slug (URL)')->required(),
                            RichEditor::make('content')->label('Isi Berita')->required()->columnSpanFull(),
                        ]),
                    ]),
                    \Filament\Schemas\Components\Group::make()->columnSpan(['default' => 1, 'md' => 1])->schema([
                        \Filament\Schemas\Components\Section::make('Pengaturan & Media')->schema([
                            Select::make('category')->label('Kategori')->options([
                                'Berita Kampus' => 'Berita Kampus',
                                'Berita Seni' => 'Berita Seni',
                                'Agenda' => 'Agenda',
                                'Festival' => 'Festival',
                                'Pameran' => 'Pameran',
                                'Seni Musik' => 'Seni Musik',
                                'Seni Rupa' => 'Seni Rupa',
                                'Seni Teater' => 'Seni Teater',
                            ])->required(),
                            FileUpload::make('image_path')->image()->label('Thumbnail'),
                            DatePicker::make('event_date')->label('Tanggal Event'),
                            Toggle::make('is_highlight')->label('Sorotan Utama')->inline(false)->hidden(fn () => auth()->user()->role === 'author'),
                            Toggle::make('is_published')->label('Terbitkan')->inline(false)->hidden(fn () => auth()->user()->role === 'author')->default(false),
                            Hidden::make('user_id')->default(fn () => auth()->id()),
                        ]),
                    ]),
            ])
            ->columns(['default' => 1, 'md' => 3]);
    }
}
