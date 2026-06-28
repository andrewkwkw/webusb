<?php

namespace App\Filament\Widgets;

use Spatie\Activitylog\Models\Activity;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class RecentActivityTableWidget extends TableWidget
{
    protected static ?int $sort = 5;
    protected int | string | array $columnSpan = 'full';
    
    protected static ?string $heading = 'Aktivitas Terbaru';

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Activity::query()->latest()->limit(10))
            ->columns([
                TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
                TextColumn::make('event')
                    ->label('Aksi')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'created' => 'success',
                        'updated' => 'warning',
                        'deleted' => 'danger',
                        default => 'secondary',
                    })
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),
                TextColumn::make('subject_type')
                    ->label('Modul')
                    ->formatStateUsing(fn (?string $state): string => $state ? class_basename($state) : '-'),
                TextColumn::make('causer.name')
                    ->label('Pelaku')
                    ->default('Sistem'),
                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(30),
            ]);
    }
}
