<?php

namespace App\Filament\Resources\LapanganModeResource\Pages;

use App\Filament\Resources\LapanganModeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLapanganMode extends EditRecord
{
    protected static string $resource = LapanganModeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
