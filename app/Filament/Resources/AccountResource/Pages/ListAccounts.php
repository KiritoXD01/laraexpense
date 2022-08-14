<?php

namespace App\Filament\Resources\AccountResource\Pages;

use App\Filament\Resources\AccountResource;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListAccounts extends ListRecords
{
    protected static string $resource = AccountResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make()
                ->label("Create account")
                ->icon('heroicon-o-plus'),
        ];
    }
}
