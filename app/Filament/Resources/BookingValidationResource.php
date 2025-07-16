<?php

namespace App\Filament\Resources;

use App\Models\BookingValidation;
use App\Filament\Resources\BookingValidationResource\Pages;
use Filament\Forms;
// use Filament\Resources\Form; // Remove this line, as it's incorrect
use Filament\Resources\Resource;
use Filament\Tables;

class BookingValidationResource extends Resource
{
    protected static ?string $model = BookingValidation::class;

    protected static ?string $navigationIcon = 'heroicon-o-check-circle';
    protected static ?string $navigationLabel = 'Booking Validations';
    protected static ?string $pluralModelLabel = 'Booking Validations';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\Select::make('booking_id')
                ->relationship('booking', 'id')
                ->required(),

            Forms\Components\TextInput::make('validated_by')
                ->required()
                ->maxLength(255),

            Forms\Components\DateTimePicker::make('validated_at')
                ->required(),
        ]);
    }

    
    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('booking.id')->label('Booking ID'),
            Tables\Columns\TextColumn::make('validated_by'),
            Tables\Columns\TextColumn::make('validated_at')->dateTime(),
            Tables\Columns\TextColumn::make('created_at')->dateTime(),
        ])
        ->filters([])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookingValidations::route('/'),
            'create' => Pages\CreateBookingValidation::route('/create'),
            'edit' => Pages\EditBookingValidation::route('/{record}/edit'),
        ];
    }
}
