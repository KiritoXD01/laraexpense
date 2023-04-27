<?php

namespace App\Filament\Widgets;

use App\Models\Account;
use App\Models\Record;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected int | string | array $columnSpan = 2;

    protected function getCards(): array
    {
        $records = Record::query()
            ->count();
        $accounts = Account::query()
            ->count();

        return [
            Card::make("Records created", $records),
            Card::make('Accounts created', $accounts)
        ];
    }
}
