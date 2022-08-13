<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RecordCategoryResource\Pages;
use App\Models\RecordCategory;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;

class RecordCategoryResource extends Resource
{
    protected static ?string $model = RecordCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationLabel = "Categories";

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->required(),
                Select::make('user_id')
                    ->required()
                    ->options(User::query()->select('id', 'name')->get()->pluck("name", 'id'))
                    ->searchable(),
                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                BooleanColumn::make('is_active')
                    ->label("Active")
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make()
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRecordCategories::route('/'),
            'create' => Pages\CreateRecordCategory::route('/create'),
            'edit' => Pages\EditRecordCategory::route('/{record}/edit'),
        ];
    }
}
