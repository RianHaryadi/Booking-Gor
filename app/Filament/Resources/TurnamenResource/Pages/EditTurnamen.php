<?php

namespace App\Filament\Resources\TurnamenResource\Pages;

use App\Filament\Resources\TurnamenResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTurnamen extends EditRecord
{
    protected static string $resource = TurnamenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
