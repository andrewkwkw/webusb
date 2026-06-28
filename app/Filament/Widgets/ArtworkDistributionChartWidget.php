<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

use App\Models\Artwork;

class ArtworkDistributionChartWidget extends ChartWidget
{
    protected static ?int $sort = 4;
    protected ?string $heading = 'Distribusi Kategori Karya';

    protected function getData(): array
    {
        $data = Artwork::selectRaw('category, count(*) as total')
            ->groupBy('category')
            ->pluck('total', 'category');

        return [
            'datasets' => [
                [
                    'label' => 'Karya',
                    'data' => $data->values()->toArray(),
                    'backgroundColor' => [
                        '#3056c4', '#fed65b', '#4ade80', '#60a5fa', '#a78bfa', '#f87171'
                    ],
                ],
            ],
            'labels' => $data->keys()->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
