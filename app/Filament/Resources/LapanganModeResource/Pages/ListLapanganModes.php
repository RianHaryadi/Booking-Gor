<?php

namespace App\Filament\Resources\LapanganModeResource\Pages;

use App\Filament\Resources\LapanganModeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLapanganModes extends ListRecords
{
    protected static string $resource = LapanganModeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
