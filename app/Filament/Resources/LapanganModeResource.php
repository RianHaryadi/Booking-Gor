<?php

namespace App\Filament\Resources;

use App\Models\LapanganMode;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Storage;
use App\Filament\Resources\LapanganModeResource\Pages;

class LapanganModeResource extends Resource
{
    protected static ?string $model = LapanganMode::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationLabel = 'Jenis Lapangan';
    protected static ?string $pluralModelLabel = 'Jenis Lapangan';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('nama_mode')
                ->label('Nama Lapangan')
                ->required()
                ->maxLength(255)
                ->placeholder('Contoh: Voli A, Futsal, Bulutangkis B'),

            Toggle::make('is_full_lapangan')
                ->label('Gunakan Seluruh Lapangan')
                ->default(true),

            TextInput::make('harga')
                ->label('Harga per 2 Jam')
                ->numeric()
                ->prefix('Rp')
                ->minValue(0)
                ->default(0)
                ->required()
                ->helperText('Masukkan harga dalam format angka, misal: 100000'),

            Textarea::make('deskripsi')
                ->label('Deskripsi Fasilitas')
                ->rows(4)
                ->nullable(),

            FileUpload::make('foto')
                ->label('Foto Fasilitas')
                ->image()
                ->directory('lapangan-fasilitas')
                ->preserveFilenames()
                ->maxSize(2048)
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_mode')
                    ->label('Nama Lapangan')
                    ->searchable()
                    ->sortable(),

                IconColumn::make('is_full_lapangan')
                    ->label('Full Lapangan')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                TextColumn::make('harga')
                    ->label('Harga per 2 Jam')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->tooltip(fn (?string $state): ?string => $state),

                ImageColumn::make('foto')
                    ->label('Foto')
                    ->square(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->headerActions([
                Action::make('importCsv')
                    ->label('Import CSV')
                    ->icon('heroicon-o-arrow-up-on-square')
                    ->form([
                        FileUpload::make('csv_file')
                            ->label('Upload File CSV')
                            ->required()
                            ->acceptedFileTypes(['text/csv', 'text/plain'])
                            ->directory('csv-temp')
                            ->storeFiles(true)
                            ->preserveFilenames(),
                    ])
                    ->action(function (array $data): void {

                        // Mendapatkan path relatif file
                        $filePath = is_array($data['csv_file']) ? ($data['csv_file']['path'] ?? $data['csv_file'][0]) : $data['csv_file'];
                        if (strpos($filePath, 'csv-temp/') !== 0) {
                            $filePath = 'csv-temp/' . $filePath;
                        }

                        // Periksa apakah file ada di disk public
                        if (!Storage::disk('public')->exists($filePath)) {
                            Notification::make()
                                ->title('File tidak ditemukan')
                                ->body('Pastikan file CSV telah diunggah dengan benar.')
                                ->danger()
                                ->send();
                            return;
                        }

                        // Dapatkan path absolut untuk membaca file
                        $absolutePath = Storage::disk('public')->path($filePath);

                        // Buka file CSV
                        $handle = fopen($absolutePath, 'r');
                        if ($handle === false) {
                            Notification::make()
                                ->title('Gagal membuka file')
                                ->danger()
                                ->send();
                            return;
                        }

                        // Baca header
                        $header = fgetcsv($handle, 0, ',');
                        $required = ['nama_mode', 'is_full_lapangan', 'harga', 'deskripsi'];

                        // Normalisasi header
                        $header = array_map('trim', array_map('strtolower', $header));

                        // Periksa apakah semua kolom wajib ada
                        if (!array_intersect($required, $header) === $required) {
                            Notification::make()
                                ->title('Format CSV salah')
                                ->danger()
                                ->body('CSV harus mengandung kolom: ' . implode(', ', $required))
                                ->send();
                            fclose($handle);
                            return;
                        }

                        // Dapatkan indeks kolom
                        $namaModeIndex = array_search('nama_mode', $header);
                        $isFullLapanganIndex = array_search('is_full_lapangan', $header);
                        $hargaIndex = array_search('harga', $header);
                        $deskripsiIndex = array_search('deskripsi', $header);

                        // Proses baris data
                        $count = 0;
                        $skipped = 0;
                        while (($row = fgetcsv($handle, 0, ',')) !== false) {

                            // Pastikan jumlah kolom cukup
                            if (count($row) < count($required)) {
                                $skipped++;
                                continue;
                            }

                            // Normalisasi data
                            $nama_mode = trim($row[$namaModeIndex] ?? '');
                            $is_full_lapangan = filter_var($row[$isFullLapanganIndex] ?? 'false', FILTER_VALIDATE_BOOLEAN);
                            $harga = (float)($row[$hargaIndex] ?? 0);
                            $deskripsi = trim($row[$deskripsiIndex] ?? '') ?: null;

                            // Cek duplikasi dan validasi
                            if (empty($nama_mode)) {
                                $skipped++;
                                continue;
                            }

                            if (LapanganMode::where('nama_mode', $nama_mode)->exists()) {
                                $skipped++;
                                continue;
                            }

                            // Simpan data
                            try {
                                LapanganMode::create([
                                    'nama_mode'        => $nama_mode,
                                    'is_full_lapangan' => $is_full_lapangan,
                                    'harga'            => $harga,
                                    'deskripsi'        => $deskripsi,
                                    'foto'             => null,
                                ]);
                                $count++;
                            } catch (\Exception $e) {
                                $skipped++;
                            }
                        }

                        fclose($handle);

                        // Hapus file setelah diproses
                        try {
                            Storage::disk('public')->delete($filePath);
                        } catch (\Exception $e) {
                        }

                        // Kirim notifikasi
                        Notification::make()
                            ->title('Import Selesai')
                            ->success()
                            ->body("✅ Berhasil mengimpor $count data. $skipped baris dilewati (duplikasi atau error).")
                            ->send();
                    }),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLapanganModes::route('/'),
            'create' => Pages\CreateLapanganMode::route('/create'),
            'edit' => Pages\EditLapanganMode::route('/{record}/edit'),
        ];
    }
}