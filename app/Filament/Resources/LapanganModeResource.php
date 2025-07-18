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
    protected static ?string $navigationGroup = 'Main Data';
    protected static ?int $navigationSort = 1;
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

            Textarea::make('description')
                ->label('Deskripsi Fasilitas')
                ->rows(4)
                ->nullable()
                ->placeholder('Contoh: Lapangan futsal dengan rumput sintetis berkualitas tinggi.'),

            FileUpload::make('image')
                ->label('Foto Lapangan')
                ->image()
                ->directory('lapangan-fasilitas')
                ->preserveFilenames()
                ->maxSize(2048)
                ->nullable(),

            TextInput::make('original_price')
                ->label('Harga Asli')
                ->numeric()
                ->required()
                ->minValue(0)
                ->placeholder('Contoh: 250000'),

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

                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->tooltip(fn (?string $state): ?string => $state),

                ImageColumn::make('image')
                    ->label('Foto')
                    ->square(),

                TextColumn::make('original_price')
                    ->label('Harga Asli')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('category')
                    ->label('Kategori')
                    ->sortable()
                    ->default('-'),

                TextColumn::make('rating')
                    ->label('Rating')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => $state ? number_format($state, 1) : '-'),
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
                        $required = ['name', 'location', 'original_price'];

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
                        $descriptionIndex = array_search('description', $header);
                        $imageIndex = array_search('image', $header);
                        $originalPriceIndex = array_search('original_price', $header);
                        $categoryIndex = array_search('category', $header);
                        $ratingIndex = array_search('rating', $header);

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
                            $description = isset($row[$descriptionIndex]) ? trim($row[$descriptionIndex] ?? '') ?: null : null;
                            $image = isset($row[$imageIndex]) ? trim($row[$imageIndex] ?? '') ?: null : null;
                            $original_price = (float)($row[$originalPriceIndex] ?? 0);
                            $category = isset($row[$categoryIndex]) ? trim($row[$categoryIndex] ?? '') ?: null : null;
                            $rating = isset($row[$ratingIndex]) ? (float)$row[$ratingIndex] : null;

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
                                    'description' => $description,
                                    'image' => $image,
                                    'original_price' => $original_price,
                                    'category' => $category,
                                    'rating' => $rating,
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