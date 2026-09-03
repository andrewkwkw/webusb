<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseStatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Artwork;
use App\Models\Archive;
use App\Models\Project;
use App\Models\User;

use App\Models\ArtNews;
use App\Models\InboxMessage;
use App\Models\OprecRegistration;

class StatsOverviewWidget extends BaseStatsOverviewWidget
{
    protected static ?int $sort = 2;
    protected ?string $pollingInterval = '60s';

    protected function getStats(): array
    {
        return [
            Stat::make('Total Karya', Artwork::count())
                ->description('Total karya seni terdaftar')
                ->descriptionIcon('heroicon-m-paint-brush')
                ->color('primary')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
            Stat::make('Total Berita', ArtNews::count())
                ->description('Jumlah berita & agenda')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('success')
                ->chart([1, 4, 3, 8, 5, 10, 12]),
            Stat::make('Oprec', OprecRegistration::count())
                ->description('Total pendaftar masuk')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('warning')
                ->chart([2, 5, 8, 12, 20, 25, 30]),
            Stat::make('Pesan Masuk', InboxMessage::count())
                ->description('Total pesan di inbox')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('info')
                ->chart([5, 2, 4, 1, 3, 6, 2]),
        ];
    }
}
