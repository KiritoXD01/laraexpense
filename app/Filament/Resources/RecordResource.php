<?php

namespace App\Filament\Resources;

use Akaunting\Money\Currency;
use Akaunting\Money\Money;
use App\Enums\RecordTypeEnum;
use App\Filament\Resources\RecordResource\Pages;
use App\Models\Record;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextInput\Mask;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Collection;

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
                    ->options(array_flip(RecordTypeEnum::options())),
                Select::make('account_id')
                    ->required()
                    ->searchable()
                    ->relationship('account', 'name'),
                TextInput::make('amount')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->default(0.00)
                    ->mask(fn (Mask $mask) => $mask->money()),
                Select::make('currency_id')
                    ->required()
                    ->searchable()
                    ->relationship('currency', 'iso'),
                DateTimePicker::make('paid_at')
                    ->default(now())
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('account.name'),
                TextColumn::make('type')
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),
                TextColumn::make('currency.iso'),
                TextColumn::make('amount')
                    ->getStateUsing(function (Record $record): string {
                        return new Money(
                            $record->amount,
                            new Currency($record->currency->iso),
                            true
                        );
                    }),

            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make('delete')
                    ->action(fn (Collection $records) => $records->each->delete())
                    ->deselectRecordsAfterCompletion()
                    ->requiresConfirmation(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageRecords::route('/'),
        ];
    }
}
