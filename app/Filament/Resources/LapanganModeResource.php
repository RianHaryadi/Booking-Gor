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
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
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
            TextInput::make('name')
                ->label('Nama Lapangan')
                ->required()
                ->maxLength(255)
                ->placeholder('Contoh: Futsal A, Voli B, Bulutangkis C'),

            TextInput::make('location')
                ->label('Lokasi')
                ->required()
                ->maxLength(255)
                ->placeholder('Contoh: Central District, Jakarta'),

            TextInput::make('distance')
                ->label('Jarak (km)')
                ->numeric()
                ->minValue(0)
                ->required()
                ->placeholder('Contoh: 2.5'),

            Textarea::make('description')
                ->label('Deskripsi Fasilitas')
                ->rows(4)
                ->nullable()
                ->placeholder('Contoh: Lapangan futsal dengan rumput sintetis berkualitas tinggi.'),

            FileUpload::make('image_url')
                ->label('Foto Lapangan')
                ->image()
                ->directory('lapangan-fasilitas')
                ->preserveFilenames()
                ->maxSize(2048)
                ->nullable(),

            TextColumn::make('original_price')
                ->label('Harga Asli')
                ->sortable()
                ->formatStateUsing(fn ($state) => 'Rp' . number_format($state, 0, ',', '.')),


            TextInput::make('discounted_price')
                ->label('Harga Diskon per 2 Jam')
                ->numeric()
                ->prefix('Rp')
                ->minValue(0)
                ->nullable()
                ->placeholder('Contoh: 280000'),

            TextInput::make('category')
                ->label('Kategori')
                ->maxLength(255)
                ->nullable()
                ->placeholder('Contoh: Premium, Eco-Friendly'),

            TextInput::make('rating')
                ->label('Rating')
                ->numeric()
                ->minValue(0)
                ->maxValue(5)
                ->step(0.1)
                ->nullable()
                ->placeholder('Contoh: 4.9'),

            TextInput::make('latitude')
                ->label('Latitude')
                ->numeric()
                ->step(0.0001)
                ->nullable()
                ->placeholder('Contoh: -6.2088'),

            TextInput::make('longitude')
                ->label('Longitude')
                ->numeric()
                ->step(0.0001)
                ->nullable()
                ->placeholder('Contoh: 106.8456'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Lapangan')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('location')
                    ->label('Lokasi')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('distance')
                    ->label('Jarak (km)')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => number_format($state, 1) . ' km'),

                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->tooltip(fn (?string $state): ?string => $state),

                ImageColumn::make('image_url')
                    ->label('Foto')
                    ->square(),

                TextColumn::make('original_price')
                    ->label('Harga Asli')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('discounted_price')
                    ->label('Harga Diskon')
                    ->money('IDR')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => $state ? 'Rp' . number_format($state, 0, ',', '.') : '-'),

                TextColumn::make('category')
                    ->label('Kategori')
                    ->sortable()
                    ->default('-'),

                TextColumn::make('rating')
                    ->label('Rating')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => $state ? number_format($state, 1) : '-'),

                TextColumn::make('latitude')
                    ->label('Latitude')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => $state ?? '-'),

                TextColumn::make('longitude')
                    ->label('Longitude')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => $state ?? '-'),
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
                        // Get the file path
                        $filePath = is_array($data['csv_file']) ? ($data['csv_file']['path'] ?? $data['csv_file'][0]) : $data['csv_file'];
                        if (strpos($filePath, 'csv-temp/') !== 0) {
                            $filePath = 'csv-temp/' . $filePath;
                        }

                        // Check if file exists
                        if (!Storage::disk('public')->exists($filePath)) {
                            Notification::make()
                                ->title('File tidak ditemukan')
                                ->body('Pastikan file CSV telah diunggah dengan benar.')
                                ->danger()
                                ->send();
                            return;
                        }

                        // Get absolute path
                        $absolutePath = Storage::disk('public')->path($filePath);

                        // Open CSV file
                        $handle = fopen($absolutePath, 'r');
                        if ($handle === false) {
                            Notification::make()
                                ->title('Gagal membuka file')
                                ->danger()
                                ->send();
                            return;
                        }

                        // Read header
                        $header = fgetcsv($handle, 0, ',');
                        $required = ['name', 'location', 'distance', 'original_price'];

                        // Normalize header
                        $header = array_map('trim', array_map('strtolower', $header));

                        // Check required columns
                        if (array_intersect($required, $header) !== $required) {
                            Notification::make()
                                ->title('Format CSV salah')
                                ->danger()
                                ->body('CSV harus mengandung kolom: ' . implode(', ', $required))
                                ->send();
                            fclose($handle);
                            return;
                        }

                        // Get column indices
                        $nameIndex = array_search('name', $header);
                        $locationIndex = array_search('location', $header);
                        $distanceIndex = array_search('distance', $header);
                        $descriptionIndex = array_search('description', $header);
                        $originalPriceIndex = array_search('original_price', $header);
                        $discountedPriceIndex = array_search('discounted_price', $header);
                        $categoryIndex = array_search('category', $header);
                        $ratingIndex = array_search('rating', $header);
                        $latitudeIndex = array_search('latitude', $header);
                        $longitudeIndex = array_search('longitude', $header);

                        // Process rows
                        $count = 0;
                        $skipped = 0;
                        while (($row = fgetcsv($handle, 0, ',')) !== false) {
                            if (count($row) < count($required)) {
                                $skipped++;
                                continue;
                            }

                            // Normalize data
                            $name = trim($row[$nameIndex] ?? '');
                            $location = trim($row[$locationIndex] ?? '');
                            $distance = (float)($row[$distanceIndex] ?? 0);
                            $description = trim($row[$descriptionIndex] ?? '') ?: null;
                            $original_price = (float)($row[$originalPriceIndex] ?? 0);
                            $discounted_price = isset($row[$discountedPriceIndex]) ? (float)$row[$discountedPriceIndex] : null;
                            $category = isset($row[$categoryIndex]) ? trim($row[$categoryIndex] ?? '') : null;
                            $rating = isset($row[$ratingIndex]) ? (float)$row[$ratingIndex] : null;
                            $latitude = isset($row[$latitudeIndex]) ? (float)$row[$latitudeIndex] : null;
                            $longitude = isset($row[$longitudeIndex]) ? (float)$row[$longitudeIndex] : null;

                            // Validate required fields
                            if (empty($name) || empty($location) || $distance <= 0 || $original_price <= 0) {
                                $skipped++;
                                continue;
                            }

                            // Check for duplicates
                            if (LapanganMode::where('name', $name)->where('location', $location)->exists()) {
                                $skipped++;
                                continue;
                            }

                            // Save data
                            try {
                                LapanganMode::create([
                                    'name' => $name,
                                    'location' => $location,
                                    'distance' => $distance,
                                    'description' => $description,
                                    'image' => null,
                                    'original_price' => $original_price,
                                    'discounted_price' => $discounted_price,
                                    'category' => $category,
                                    'rating' => $rating,
                                    'latitude' => $latitude,
                                    'longitude' => $longitude,
                                ]);
                                $count++;
                            } catch (\Exception $e) {
                                $skipped++;
                            }
                        }

                        fclose($handle);

                        // Delete file after processing
                        try {
                            Storage::disk('public')->delete($filePath);
                        } catch (\Exception $e) {
                        }

                        // Send notification
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