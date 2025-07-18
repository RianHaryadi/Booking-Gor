<?php

namespace App\Filament\Resources\TurnamenResource\Pages;

use App\Filament\Resources\TurnamenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTurnamens extends ListRecords
{
    protected static string $resource = TurnamenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
