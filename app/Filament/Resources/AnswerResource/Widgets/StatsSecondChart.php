<?php

namespace App\Filament\Resources\AnswerResource\Widgets;

use Filament\Widgets\ChartWidget;

class StatsSecondChart extends ChartWidget
{
    protected static ?string $heading = 'Stats #2';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Example #2',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'bubble';
    }

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            'week' => 'Last week',
            'month' => 'Last month',
            'year' => 'This year',
        ];
    }
}
