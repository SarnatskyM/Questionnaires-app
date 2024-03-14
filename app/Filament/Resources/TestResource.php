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
use Filament\Tables\Columns\IconColumn;

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
                            ->prefix('https://nosu-blank.ru/test/')
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
                TextColumn::make('slug')
                    ->copyable()
                    ->copyMessage('URL скопирован')
                    ->copyMessageDuration(1500)
                    ->copyableState(fn (string $state): string => "https://nosu-blank.ru/test/{$state}")
                    ->searchable()
                    ->prefix('https://nosu-blank.ru/test/')
                    ->label('Уникальный URL'),

                IconColumn::make('is_active')
                    ->label('Активирован')
                    ->boolean(),
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
