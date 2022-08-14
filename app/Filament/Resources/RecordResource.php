<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RecordResource\Pages;
use App\Models\Record;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;

class RecordResource extends Resource
{
    protected static ?string $model = Record::class;

    protected static ?string $navigationIcon = 'heroicon-o-switch-horizontal';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('type')
                    ->required()
                    ->searchable()
                    ->options()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageRecords::route('/'),
        ];
    }
}
