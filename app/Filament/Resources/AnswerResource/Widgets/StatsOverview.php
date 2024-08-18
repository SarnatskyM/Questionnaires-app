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
            Stat::make('Number of responses', Answer::all()->count()),
            Stat::make('Number of respondents', Respondent::all()->count()),
            Stat::make('Tests', Test::all()->count()),
        ];
    }
}
