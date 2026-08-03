<?php

namespace App\Filament\Resources\InboxMessages;

use App\Filament\Resources\InboxMessages\Pages\ManageInboxMessages;
use App\Models\InboxMessage;
use BackedEnum;
use UnitEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InboxMessageResource extends Resource
{
    protected static ?string $model = InboxMessage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEnvelope;
    

    protected static string|\UnitEnum|null $navigationGroup = 'Pendaftaran & Interaksi';
    protected static ?string $navigationLabel = 'Pesan Masuk';
    protected static ?string $pluralModelLabel = 'Pesan Masuk';
    protected static ?string $modelLabel = 'Pesan';

    protected static ?string $recordTitleAttribute = 'subject';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Detail Pesan')
                    ->schema([
                        TextEntry::make('name')->label('Nama Pengirim'),
                        TextEntry::make('email')->label('Email Pengirim'),
                        TextEntry::make('subject')->label('Subjek'),
                        TextEntry::make('created_at')->label('Waktu Kirim')->dateTime(),
                        TextEntry::make('message')->label('Isi Pesan')->columnSpanFull(),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Pengirim')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('subject')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Waktu Kirim')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                DeleteAction::make()->visible(fn () => auth()->user()->role === 'admin'),
            ])
            ->toolbarActions([
                //
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageInboxMessages::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canAccess(): bool
    {
        return in_array(auth()->user()->role, ['admin', 'editor']);
    }
}
