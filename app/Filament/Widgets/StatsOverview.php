<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected int | string | array $columnSpan = 2;

    protected function getCards(): array
    {
        return [
            Card::make("Records created", 0)
        ];
    }
}
