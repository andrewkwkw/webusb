<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseStatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Artwork;
use App\Models\Archive;
use App\Models\Project;
use App\Models\User;

class StatsOverviewWidget extends BaseStatsOverviewWidget
{
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Karya', Artwork::count())
                ->description('Total karya seni terdaftar')
                ->descriptionIcon('heroicon-m-paint-brush')
                ->color('primary'),
            Stat::make('Total Arsip', Archive::count())
                ->description('Jumlah arsip kebudayaan')
                ->descriptionIcon('heroicon-m-archive-box')
                ->color('success'),
            Stat::make('Total Proyek', Project::count())
                ->description('Proyek UKM yang dicatat')
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('warning'),
            Stat::make('Pengguna Aktif', User::count())
                ->description('Total admin & anggota')
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),
        ];
    }
}
