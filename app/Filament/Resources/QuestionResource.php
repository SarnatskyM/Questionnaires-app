<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuestionResource\Pages;
use App\Filament\Resources\QuestionResource\RelationManagers\OptionsRelationManager;
use App\Models\Question;
use App\Models\Test;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
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

    protected static ?string $label = "Question";

    protected static ?string $modelLabel = "Question";

    protected static ?string $pluralLabel = "Questions";

    protected static ?string $pluralModelLabel = "Questions";

    protected static ?string $navigationGroup = 'General';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema(
                        [
                            Select::make('test_id')
                                ->options(Test::all()->pluck('title', 'id'))
                                ->label('Test')
                                ->columnSpanFull()
                                ->required(),

                            RichEditor::make('question_text')
                                ->label('Question text')
                                ->columnSpanFull()
                                ->required(),

                            Select::make('type')
                                ->label('Type answer')
                                ->required()
                                ->options([
                                    'text' => 'Button',
                                    'select' => 'Dropdown list',
                                    'free_text' => 'Free answer',
                                    'strange_check' => 'Marking'
                                ]),
                            Section::make()
                                ->columns(2)
                                ->schema([
                                    Toggle::make('is_prural')
                                        ->default(false)
                                        ->label('Multiple answer options'),

                                    Toggle::make('is_required')
                                        ->default(false)
                                        ->label('Required'),
                                ]),


                            TextInput::make('sort')
                                ->label('Sort')
                                ->integer()
                                ->default(0)
                        ]
                    )
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('test.title')->label('Test'),
                TextColumn::make('question_text')->wrap()->html()->label('Question'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Test')
                    ->options(Test::all()->pluck('title', 'id'))
                    ->attribute('test_id')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
