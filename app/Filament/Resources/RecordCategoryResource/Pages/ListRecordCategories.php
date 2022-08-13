<?php

namespace App\Filament\Resources\RecordCategoryResource\Pages;

use App\Filament\Resources\RecordCategoryResource;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRecordCategories extends ListRecords
{
    protected static string $resource = RecordCategoryResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make()
                ->label("Create new category")
                ->icon('heroicon-o-plus'),
        ];
    }
}
