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

    protected static ?string $label = "Test";

    protected static ?string $modelLabel = "Tests";

    protected static ?string $pluralLabel = "Tests";

    protected static ?string $pluralModelLabel = "Tests";

    protected static ?string $navigationGroup = 'General';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema(
                    [
                        TextInput::make('title')
                            ->label('Title')
                            ->columnSpanFull()
                            ->required(),

                        RichEditor::make('description')
                            ->label('Description')
                            ->columnSpanFull(),

                        TextInput::make('slug')
                            ->label('unique URL')
                            ->prefix('http://{your-domain}/test/')
                            ->required()
                            ->columnSpanFull(),

                        Toggle::make('is_active')
                            ->label('Activate')
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
                TextColumn::make('title')->searchable()->label('Title'),
                TextColumn::make('description')->html()->wrap()->label('Description'),
                TextColumn::make('slug')
                    ->copyable()
                    ->copyMessage('URL copy')
                    ->copyMessageDuration(1500)
                    ->copyableState(fn (string $state): string => "http://{your-domain}/test/{$state}")
                    ->searchable()
                    ->prefix('http://{your-domain}/test/')
                    ->label('unique URL'),

                IconColumn::make('is_active')
                    ->label('Activate')
                    ->boolean(),
            ])
            ->filters([
                //
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
