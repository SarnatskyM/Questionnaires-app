<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnswerResource\Pages;
use App\Filament\Resources\AnswerResource\Widgets\StatsOverview;
use App\Models\Answer;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AnswerResource extends Resource
{
    protected static ?string $model = Answer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $label = "Result";

    protected static ?string $modelLabel = "Result";

    protected static ?string $pluralLabel = "Results";

    protected static ?string $pluralModelLabel = "Results";

    protected static ?string $navigationGroup = 'Settings';

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
                    ->label('Title test'),
                TextColumn::make('question.question_text')
                    ->html()
                    ->wrap()
                    ->label('Question'),
                TextColumn::make('option.option_text')
                    ->wrap()
                    ->label('Answer'),
                TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime()

            ])
            ->filters([
                //
            ])
            ->actions([
            ])
            ->bulkActions([

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
        ];
    }
}
