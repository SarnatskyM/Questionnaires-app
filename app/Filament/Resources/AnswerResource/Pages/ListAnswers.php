<?php

namespace App\Filament\Resources\AnswerResource\Pages;

use App\Filament\Resources\AnswerResource;
use App\Filament\Resources\AnswerResource\Widgets\StatsOverview;
use App\Imports\MyClientImport;
use App\Models\Test;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ListAnswers extends ListRecords
{
    protected static string $resource = AnswerResource::class;

    protected function getHeaderActions(): array
    {
        return [
       
           
        ];
    }

    public function getTabs(): array
    {
        $tests = Test::all();
        $testsResults = [
            'Все' => Tab::make(),
        ];
        foreach ($tests as $test) {
            $testsResults[$test->title] = Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('test_id', $test->id));
        }
        return $testsResults;
    }

    protected function getHeaderWidgets(): array
    {
        return [
            StatsOverview::class,
        ];
    }
}
