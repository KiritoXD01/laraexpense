<?php

namespace App\Filament\Resources\RecordLabelResource\Pages;

use App\Filament\Resources\RecordLabelResource;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageRecordLabels extends ManageRecords
{
    protected static string $resource = RecordLabelResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make()
                ->icon('heroicon-o-plus')
                ->label('Create label'),
        ];
    }
}
