<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuestionResource\Pages;
use App\Filament\Resources\QuestionResource\RelationManagers\OptionsRelationManager;
use App\Models\Question;
use App\Models\Test;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static ?string $label = "Вопрос";

    protected static ?string $modelLabel = "Вопрос";

    protected static ?string $pluralLabel = "Вопросы";

    protected static ?string $pluralModelLabel = "Вопросы";

    protected static ?string $navigationGroup = 'Общее';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema(
                    [
                        Select::make('test_id')
                            ->options(Test::all()->pluck('title', 'id'))
                            ->label('Тест')
                            ->columnSpanFull()
                            ->required(),

                        RichEditor::make('question_text')
                            ->label('Вопрос')
                            ->columnSpanFull()
                            ->required()
                    ]
                )
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('test.title')->label('Тест'),
                TextColumn::make('question_text')->wrap()->html()->label('Вопрос')
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Анкета')
                    ->options(Test::all()->pluck('title', 'id'))
                    ->attribute('test_id')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            OptionsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'edit' => Pages\EditQuestion::route('/{record}/edit'),
        ];
    }
}
