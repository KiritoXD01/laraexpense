<?php

namespace App\Filament\Resources\RecordResource\Pages;

use App\Filament\Resources\RecordResource;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords as FilamentManageRecords;

class ManageRecords extends FilamentManageRecords
{
    protected static string $resource = RecordResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make()
                ->icon('heroicon-o-plus')
                ->label('Create record'),
        ];
    }
}
