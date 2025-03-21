<?php

namespace App\Filament\Resources\AccountResource\Widgets;

use App\Models\Account;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AccountBalanceWidget extends BaseWidget
{
    public ?Account $record = null;

    protected function getStats(): array
    {
        return [
            Stat::make('Account Balance', $this->record->balance),
        ];
    }
}
