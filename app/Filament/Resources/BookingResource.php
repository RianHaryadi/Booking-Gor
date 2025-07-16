<?php

namespace App\Filament\Resources;

use App\Models\Booking;
use App\Models\LapanganMode;
use App\Services\BookingValidator;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Notifications\Notification;
use Illuminate\Validation\ValidationException;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\BookingResource\Pages;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Booking Lapangan';
    protected static ?string $pluralModelLabel = 'Booking Lapangan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('lapangan_mode_id')
                    ->label('Jenis Lapangan')
                    ->relationship('lapanganMode', 'name')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $get, callable $set) => self::updateTotalHarga($get, $set)),

                DatePicker::make('tanggal')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $get, callable $set) => self::updateTotalHarga($get, $set)),

                TimePicker::make('jam_mulai')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $get, callable $set) => self::updateTotalHarga($get, $set)),

                TimePicker::make('jam_selesai')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $get, callable $set) => self::updateTotalHarga($get, $set)),

                TextInput::make('nama_pemesan')->required(),

                TextInput::make('nomor_telepon')->tel(),

                TextInput::make('email')->email(),

                Select::make('metode_pembayaran')
                    ->label('Metode Pembayaran')
                    ->options([
                        'cash' => 'Cash',
                        'transfer' => 'Transfer Bank',
                        'qris' => 'QRIS',
                    ])
                    ->default('cash')
                    ->required(),

                TextInput::make('total_harga')
                    ->numeric()
                    ->prefix('Rp')
                    ->readOnly()
                    ->helperText('Akan dihitung otomatis berdasarkan durasi dan harga lapangan.')
                    ->afterStateHydrated(function (TextInput $component, ?string $state, callable $set, callable $get) {
                        $jamMulai = strtotime($get('jam_mulai'));
                        $jamSelesai = strtotime($get('jam_selesai'));
                        $durasiJam = ($jamSelesai - $jamMulai) / 3600;
                        $lapanganMode = LapanganMode::find($get('lapangan_mode_id'));
                        if ($lapanganMode && $durasiJam > 0) {
                            $set('total_harga', $lapanganMode->harga * ($durasiJam / 2));
                        }
                    }),

                Select::make('status')
                    ->options([
                        'booked' => 'Booked',
                        'cancelled' => 'Cancelled',
                        'completed' => 'Completed',
                    ])
                    ->default('booked'),

                Hidden::make('kode_booking'),
            ]);
    }

    protected static function updateTotalHarga(callable $get, callable $set): void
    {
        $lapanganModeId = $get('lapangan_mode_id');
        $jamMulai = $get('jam_mulai');
        $jamSelesai = $get('jam_selesai');

        if ($lapanganModeId && $jamMulai && $jamSelesai) {
            $jamMulaiTime = strtotime($jamMulai);
            $jamSelesaiTime = strtotime($jamSelesai);
            $durasiJam = ($jamSelesaiTime - $jamMulaiTime) / 3600;

            if ($durasiJam > 0) {
                $lapanganMode = LapanganMode::find($lapanganModeId);
                if ($lapanganMode) {
                    $hargaPer2Jam = $lapanganMode->harga;
                    $totalHarga = $hargaPer2Jam * ($durasiJam / 2);
                    $set('total_harga', $totalHarga);
                }
            }
        }
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        if (!BookingValidator::isAvailable(
            $data['lapangan_mode_id'],
            $data['tanggal'],
            $data['jam_mulai'],
            $data['jam_selesai']
        )) {
            Notification::make()
                ->title('Jadwal bentrok')
                ->danger()
                ->body('Waktu yang dipilih sedang dipakai. Silakan pilih waktu lain.')
                ->send();

            throw ValidationException::withMessages([
                'tanggal' => 'Waktu sudah dibooking.',
            ]);
        }

        if (empty($data['kode_booking'])) {
            $data['kode_booking'] = 'BK-' . date('Ymd') . '-' . strtoupper(uniqid());
        }

        $jamMulai = strtotime($data['jam_mulai']);
        $jamSelesai = strtotime($data['jam_selesai']);
        $durasiJam = ($jamSelesai - $jamMulai) / 3600;
        $lapanganMode = LapanganMode::find($data['lapangan_mode_id']);

        if ($lapanganMode) {
            $data['total_harga'] = $lapanganMode->harga * ($durasiJam / 2);
        }

        return $data;
    }

    public static function mutateFormDataBeforeSave(array $data): array
    {
        if (!BookingValidator::isAvailable(
            $data['lapangan_mode_id'],
            $data['tanggal'],
            $data['jam_mulai'],
            $data['jam_selesai'],
            $data['id'] ?? null
        )) {
            Notification::make()
                ->title('Jadwal bentrok')
                ->danger()
                ->body('Waktu yang dipilih sedang dipakai. Silakan pilih waktu lain.')
                ->send();

            throw ValidationException::withMessages([
                'tanggal' => 'Waktu sudah dibooking.',
            ]);
        }

        $jamMulai = strtotime($data['jam_mulai']);
        $jamSelesai = strtotime($data['jam_selesai']);
        $durasiJam = ($jamSelesai - $jamMulai) / 3600;
        $lapanganMode = LapanganMode::find($data['lapangan_mode_id']);

        if ($lapanganMode) {
            $data['total_harga'] = $lapanganMode->harga * ($durasiJam / 2);
        }

        return $data;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_booking')->label('Kode')->searchable(),
                TextColumn::make('lapanganMode.name')->label('Lapangan'),
                TextColumn::make('tanggal')->date()->sortable(),
                TextColumn::make('jam_mulai')->time(),
                TextColumn::make('jam_selesai')->time(),
                TextColumn::make('total_harga')->money('IDR'),
                TextColumn::make('status')->badge(),
            ])
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}