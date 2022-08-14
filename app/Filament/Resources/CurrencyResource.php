<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CurrencyResource\Pages;
use App\Models\Currency;
use Cknow\Money\Money;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CurrencyResource extends Resource
{
    protected static ?string $model = Currency::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereBelongsTo(auth()->user());
    }

    public static function form(Form $form): Form
    {
        $currencies = collect(Money::getISOCurrencies())
            ->pluck('currency', 'alphabeticCode')
            ->toArray();

        return $form
            ->schema([
                Select::make('iso')
                    ->label('Currency')
                    ->required()
                    ->options($currencies)
                    ->searchable()
                    ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        $currencies = collect(Money::getISOCurrencies())
            ->pluck('currency', 'alphabeticCode')
            ->toArray();

        return $table
            ->columns([
                TextColumn::make('iso')
                    ->label('Name')
                    ->formatStateUsing(function (string $state) use ($currencies): string {
                        return "$state - $currencies[$state]";
                    }),
            ])
            ->filters([])
            ->actions([
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
            'index' => Pages\ManageCurrencies::route('/'),
        ];
    }
}
