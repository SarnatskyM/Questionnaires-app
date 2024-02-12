<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestResource\Pages;
use App\Models\Test;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\Toggle;

class TestResource extends Resource
{
    protected static ?string $model = Test::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-oval-left-ellipsis';

    protected static ?string $label = "Тест";

    protected static ?string $modelLabel = "Тест";

    protected static ?string $pluralLabel = "Тесты";

    protected static ?string $pluralModelLabel = "Тесты";

    protected static ?string $navigationGroup = 'Общее';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema(
                    [
                        TextInput::make('title')
                            ->label('Название')
                            ->columnSpanFull()
                            ->required(),

                        RichEditor::make('description')
                            ->label('Описание')
                            ->columnSpanFull(),

                        TextInput::make('slug')
                            ->label('Уникальный URL')
                            ->required()
                            ->columnSpanFull(),

                        Toggle::make('is_active')
                            ->label('Активировать')
                            ->default(false)
                            ->columnSpanFull()
                    ]
                )
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable()->label('Название'),
                TextColumn::make('description')->html()->wrap()->label('Описание'),
                TextColumn::make('slug')->searchable()->label('Уникальный URL'),
                TextColumn::make('is_active')->label('Активировать')
            ])
            ->filters([
                //
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTests::route('/'),
            'create' => Pages\CreateTest::route('/create'),
            'edit' => Pages\EditTest::route('/{record}/edit'),
        ];
    }
}
