<?php

namespace App\Filament\Resources;

use Akaunting\Money\Currency;
use Akaunting\Money\Money;
use App\Enums\AccountTypeEnum;
use App\Filament\Resources\AccountResource\Pages;
use App\Models\Account;
use Filament\Forms\Components\ColorPicker;
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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class AccountResource extends Resource
{
    protected static ?string $model = Account::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('currency')->whereBelongsTo(auth()->user());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                ColorPicker::make('color')
                    ->required()
                    ->default('#000000'),
                Select::make('type')
                    ->required()
                    ->searchable()
                    ->options(array_flip(AccountTypeEnum::options()))
                    ->columnSpan('full'),
                TextInput::make('starting_amount')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->default(0.00)
                    ->mask(fn (Mask $mask) => $mask
                        ->money()
                    ),
                Select::make('currency_id')
                    ->required()
                    ->searchable()
                    ->relationship(
                        'currency',
                        'iso',
                        fn (Builder $query) => $query->whereBelongsTo(auth()->user())
                    ),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('type')
                    ->formatStateUsing(fn (string $state): string => ucfirst($state))
                    ->sortable(),
                TextColumn::make('currency.iso'),
                TextColumn::make('starting_amount')
                    ->getStateUsing(function ($record): string {
                        return new Money(
                            $record->starting_amount,
                            new Currency($record->currency->iso),
                            true
                        );
                    }),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
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
            'index' => Pages\ListAccounts::route('/'),
            'create' => Pages\CreateAccount::route('/create'),
            'edit' => Pages\EditAccount::route('/{record}/edit'),
        ];
    }
}
