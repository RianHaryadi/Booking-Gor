<?php

namespace App\Filament\Resources;

use App\Models\BookingValidation;
use App\Filament\Resources\BookingValidationResource\Pages;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Notifications\Notification;

class BookingValidationResource extends Resource
{
    protected static ?string $model = BookingValidation::class;

    protected static ?string $navigationIcon = 'heroicon-o-check-circle';
    protected static ?string $navigationLabel = 'Booking Validations';
    protected static ?string $pluralModelLabel = 'Booking Validations';
    protected static ?string $navigationGroup = 'Main Data';
    protected static ?int $navigationSort = 3;
    
    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\Select::make('booking_id')
                ->relationship('booking', 'id')
                ->required(),

            Forms\Components\TextInput::make('kode_booking')
                ->required()
                ->maxLength(255),

            Forms\Components\Select::make('status')
                ->required()
                ->options([
                    'booked' => 'Booked',
                    'pembersihan' => 'Pembersihan',
                    'tersedia' => 'Tersedia',
                ])
                ->native(false),

            Forms\Components\TextInput::make('total_harga')
                ->numeric()
                ->required(),

            Forms\Components\DatePicker::make('tanggal')
                ->required(),

            Forms\Components\TimePicker::make('jam_mulai')
                ->required()
                ->reactive()
                ->afterStateUpdated(fn ($state, callable $get, callable $set) => self::updateDurasi($get, $set)),

            Forms\Components\TimePicker::make('jam_selesai')
                ->required()
                ->reactive()
                ->afterStateUpdated(fn ($state, callable $get, callable $set) => self::updateDurasi($get, $set)),

            Forms\Components\TextInput::make('durasi')
                ->numeric()
                ->readOnly()
                ->label('Durasi (jam)')
                ->required(),

            Forms\Components\TextInput::make('nama_pemesan')
                ->required()
                ->maxLength(255),
        ]);
    }

    protected static function updateDurasi(callable $get, callable $set): void
    {
        $start = strtotime($get('jam_mulai'));
        $end = strtotime($get('jam_selesai'));

        if ($start && $end && $end > $start) {
            $durasi = ($end - $start) / 3600;
            $set('durasi', $durasi);
        }
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('booking.id')->label('Booking ID'),
                Tables\Columns\TextColumn::make('kode_booking'),
                Tables\Columns\TextColumn::make('status')->badge(),
                Tables\Columns\TextColumn::make('total_harga')->money('IDR'),
                Tables\Columns\TextColumn::make('tanggal')->date(),
                Tables\Columns\TextColumn::make('jam_mulai'),
                Tables\Columns\TextColumn::make('jam_selesai'),
                Tables\Columns\TextColumn::make('durasi')->label('Durasi (jam)'),
                Tables\Columns\TextColumn::make('nama_pemesan'),
                Tables\Columns\TextColumn::make('created_at')->since(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

                Tables\Actions\Action::make('mark_pembersihan')
                    ->label('Pembersihan')
                    ->icon('heroicon-o-sparkles')
                    ->color('warning')
                    ->visible(fn ($record) => $record->status === 'booked')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->update(['status' => 'pembersihan']);
                        Notification::make()
                            ->title('Status diubah menjadi "Pembersihan".')
                            ->success()
                            ->send();
                    }),

                Tables\Actions\Action::make('mark_selesai')
                    ->label('Selesai')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => $record->status === 'pembersihan')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->update(['status' => 'tersedia']);
                        $record->booking()->update(['status' => 'completed']);
                        Notification::make()
                            ->title('Status diubah menjadi "Tersedia" dan Booking selesai.')
                            ->success()
                            ->send();
                    }),
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
