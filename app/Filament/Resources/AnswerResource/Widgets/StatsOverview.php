<?php

namespace App\Filament\Resources\AnswerResource\Widgets;

use App\Models\Answer;
use App\Models\Respondent;
use App\Models\Test;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Количество ответов', Answer::all()->count()),
            Stat::make('Количество респондентов', Respondent::all()->count()),
            Stat::make('Тестов', Test::all()->count()),
        ];
    }
}
