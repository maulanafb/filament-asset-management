<?php

namespace App\Filament\Widgets;

use App\Models\Asset;

use App\Models\MaintenanceHistory;

use App\Models\User;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget;

class DashboardStats extends StatsOverviewWidget
{
    use InteractsWithPageTable;

    protected static ?string $pollingInterval = null;

    protected function getStats(): array
    {
        $assetValue = Asset::all()->sum(function ($asset) {
            return $asset->price * $asset->qty;
        });
        // dd($assetValue);
        return [
            StatsOverviewWidget\Stat::make(__('User'), User::count())
                ->icon('heroicon-o-user-group')
                ->color('blue'),
            StatsOverviewWidget\Stat::make(__('Assets'), Asset::count())
                ->icon('heroicon-s-archive-box')
                ->color('green'),
            StatsOverviewWidget\Stat::make(__('Total Asset Value'), 'Rp. ' . number_format($assetValue, 0, ',', '.'))
                ->icon('heroicon-s-currency-dollar')
                ->color('yellow'),


        ];
    }

    private function calculateDifferentPercentage($lastMonth, $thisMonth): string
    {
        if ($lastMonth == $thisMonth) {
            return 0;
        }

        if ($lastMonth == 0 && $thisMonth == 0) {
            return 0;
        }

        if ($lastMonth == 0 && $thisMonth > 0) {
            return 100;
        }

        if ($lastMonth > 0 && $thisMonth == 0) {
            return -100;
        }

        return (($thisMonth - $lastMonth) / $lastMonth) * 100;
    }
}
