<?php

namespace App\Filament\Resources\BookingValidationResource\Pages;

use App\Filament\Resources\BookingValidationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBookingValidation extends EditRecord
{
    protected static string $resource = BookingValidationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
