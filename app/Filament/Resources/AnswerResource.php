<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnswerResource\Pages;
use App\Filament\Resources\AnswerResource\Widgets\StatsOverview;
use App\Models\Answer;
use Filament\Actions\ExportAction;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AnswerResource extends Resource
{
    protected static ?string $model = Answer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $label = "Результат";

    protected static ?string $modelLabel = "Результат";

    protected static ?string $pluralLabel = "Результаты";

    protected static ?string $pluralModelLabel = "Результаты";

    protected static ?string $navigationGroup = 'Вывод';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema(
                    []
                )
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->reorderable('id', 'desc')
            ->columns([
                TextColumn::make('test.title')
                    ->label('Название теста'),
                TextColumn::make('question.question_text')
                    ->html()
                    ->wrap()
                    ->label('Вопрос'),
                TextColumn::make('option.option_text')
                    ->wrap()
                    ->label('Ответ'),
                TextColumn::make('created_at')
                    ->label('Время ответа')
                    ->dateTime()

            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // ExportBulkAction::make()->exports([
                //     ExcelExport::make()
                //         ->askForFilename()
                // ]),
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getWidgets(): array
    {
        return [
            StatsOverview::class,
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAnswers::route('/'),
            'create' => Pages\CreateAnswer::route('/create'),
            'edit' => Pages\EditAnswer::route('/{record}/edit'),
        ];
    }
}
