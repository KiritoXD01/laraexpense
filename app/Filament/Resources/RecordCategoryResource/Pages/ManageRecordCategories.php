<?php

namespace App\Filament\Resources\RecordCategoryResource\Pages;

use App\Filament\Resources\RecordCategoryResource;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageRecordCategories extends ManageRecords
{
    protected static string $resource = RecordCategoryResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make()
                ->icon("heroicon-o-plus")
                ->label("Create category"),
        ];
    }
}
