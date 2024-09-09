<?php

namespace App\Filament\Exports;

use App\Models\Asset;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Facades\Log;

class AssetExporter extends Exporter
{
    protected static ?string $model = Asset::class;

    public static function getColumns(): array
    {
        return [

            ExportColumn::make('serial_number'),
            ExportColumn::make('name'),
            ExportColumn::make('image'),
            ExportColumn::make('qty'),
            ExportColumn::make('price'),
            ExportColumn::make('brand.name'),
            ExportColumn::make('category.name'),
            ExportColumn::make('room.name'),
            ExportColumn::make('condition')
                ->formatStateUsing(function ($state, $record) {
                    // Ensure $state is a string or return a string representation
                    if ($state instanceof \App\AssetCondition) {
                        return $state->name; // Assuming `name` is a string attribute in AssetCondition
                    }
                    if (!isset($state)) {
                        Log::warning('Missing condition for asset ID: ' . $record->id);
                        return 'Unknown'; // Default value when condition is missing
                    }
                    return (string) $state; // Ensure $state is cast to string
                }),
            ExportColumn::make('purchase_date'),
            ExportColumn::make('user.name'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        Log::info('Export completed with ' . $export->successful_rows . ' successful rows.');

        $body = 'Your asset export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }

    protected static function getQuery()
    {
        return parent::getQuery()->with(['brand', 'category', 'room', 'user']); // Add relationships to ensure they are loaded
    }
}
