<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

use App\Models\Archive;

class ArchiveDistributionChartWidget extends ChartWidget
{
    protected static ?int $sort = 4;
    protected ?string $heading = 'Distribusi Arsip per Kategori';
    protected ?string $pollingInterval = '60s';

    protected function getData(): array
    {
        // Group by category/activity_type
        $data = Archive::selectRaw('activity_type as category, count(*) as total')
            ->groupBy('activity_type')
            ->pluck('total', 'category');

        return [
            'datasets' => [
                [
                    'label' => 'Arsip',
                    'data' => $data->values()->toArray(),
                    'backgroundColor' => [
                        '#0038a8', '#f59e0b', '#10b981', '#3b82f6', '#8b5cf6', '#ef4444'
                    ],
                ],
            ],
            'labels' => $data->keys()->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
