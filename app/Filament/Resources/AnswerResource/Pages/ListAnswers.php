<?php

namespace App\Filament\Resources\AnswerResource\Pages;

use App\Filament\Resources\AnswerResource;
use App\Filament\Resources\AnswerResource\Widgets\StatsOverview;
use App\Models\Test;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;

class ListAnswers extends ListRecords
{
    protected static string $resource = AnswerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exports([
                    ExcelExport::make()
                        ->fromTable()
                        ->withFilename(fn ($resource) => $resource::getModelLabel() . '-' . date('Y-m-d'))
                        ->withWriterType(\Maatwebsite\Excel\Excel::CSV)
                        ->withColumns([
                            Column::make('test.title'),
                            Column::make('question.question_text'),
                            Column::make('option.option_text'),
                            Column::make('created_at'),
                        ])
                ]),
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
