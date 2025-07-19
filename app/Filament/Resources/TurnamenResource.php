<?php

namespace App\Filament\Resources;

use App\Models\Turnamen;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Components\{TextInput, Textarea, DatePicker, FileUpload, Select, Section};
use Filament\Tables\Columns\{TextColumn, ImageColumn, BadgeColumn};
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\{ViewAction, EditAction, DeleteAction, DeleteBulkAction, ActionGroup};
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Storage;

use App\Filament\Resources\TurnamenResource\Pages;

class TurnamenResource extends Resource
{
    protected static ?string $model = Turnamen::class;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';
    protected static ?string $navigationGroup = 'Turnamen';
    protected static ?string $modelLabel = 'Turnamen';
    protected static ?string $pluralModelLabel = 'Turnamen';
    protected static ?int $navigationSort = 1;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Section::make('Informasi Umum')
                ->schema([
                    TextInput::make('nama')
                        ->label('Nama Turnamen')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Masukkan nama turnamen'),

                    Textarea::make('deskripsi')
                        ->label('Deskripsi')
                        ->rows(4)
                        ->placeholder('Deskripsikan turnamen secara singkat')
                        ->columnSpanFull(),

                    TextInput::make('lokasi')
                        ->label('Lokasi')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Masukkan lokasi turnamen'),

                    DatePicker::make('tanggal_mulai')
                        ->label('Tanggal Mulai')
                        ->required()
                        ->minDate(now())
                        ->reactive(),

                    DatePicker::make('tanggal_selesai')
                        ->label('Tanggal Selesai')
                        ->required()
                        ->minDate(fn (Get $get) => $get('tanggal_mulai') ?: now()),

                    Select::make('kategori')
                        ->label('Kategori')
                        ->options([
                            'single' => 'Single',
                            'team' => 'Team',
                        ])
                        ->required()
                        ->placeholder('Pilih kategori turnamen'),

                    Select::make('status')
                        ->label('Status')
                        ->options([
                            'upcoming' => 'Upcoming',
                            'ongoing' => 'Ongoing',
                            'completed' => 'Completed',
                        ])
                        ->default('upcoming')
                        ->required()
                        ->placeholder('Pilih status turnamen'),

                    TextInput::make('linkpendaftaran')
                        ->label('Link Pendaftaran')
                        ->url()
                        ->placeholder('https://example.com')
                        ->suffixIcon('heroicon-o-link')
                        ->maxLength(255)
                        ->columnSpanFull(),
                ])
                ->columns(2),

            Section::make('Media & Hadiah')
                ->schema([
                    FileUpload::make('poster')
                        ->label('Poster Turnamen')
                        ->image()
                        ->imagePreviewHeight('150')
                        ->directory('turnamen/poster')
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                        ->maxSize(2048)
                        ->downloadable()
                        ->placeholder('Unggah poster turnamen'),

                    TextInput::make('hadiah')
                        ->label('Total Hadiah (Rp)')
                        ->numeric()
                        ->minValue(0)
                        ->prefix('Rp')
                        ->required()
                        ->placeholder('Masukkan total hadiah'),
                ])
                ->columns(1),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                ImageColumn::make('poster')
                    ->label('Poster')
                    ->circular()
                    ->defaultImageUrl(asset('images/default-poster.jpg')),

                TextColumn::make('nama')->sortable()->searchable()->wrap(),
                TextColumn::make('lokasi')->sortable()->searchable()->wrap(),
                TextColumn::make('tanggal_mulai')->label('Mulai')->date('d M Y'),
                TextColumn::make('tanggal_selesai')->label('Selesai')->date('d M Y'),

                BadgeColumn::make('kategori')
                    ->colors([
                        'primary' => 'single',
                        'secondary' => 'team',
                    ])
                    ->formatStateUsing(fn (string $state) => ucfirst($state)),

                BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'upcoming',
                        'info' => 'ongoing',
                        'success' => 'completed',
                    ])
                    ->formatStateUsing(fn (string $state) => ucfirst($state)),

                TextColumn::make('hadiah')->label('Hadiah')->money('IDR', true),

                TextColumn::make('linkpendaftaran')
                ->label('Link Pendaftaran')
                ->url(fn ($record) => $record->linkpendaftaran, true)
                ->openUrlInNewTab()
                ->limit(30),
            ])
            ->defaultSort('tanggal_mulai', 'desc')
            ->filters([
                SelectFilter::make('kategori')
                    ->label('Filter Kategori')
                    ->options([
                        'single' => 'Single',
                        'team' => 'Team',
                    ]),
                SelectFilter::make('status')
                    ->label('Filter Status')
                    ->options([
                        'upcoming' => 'Upcoming',
                        'ongoing' => 'Ongoing',
                        'completed' => 'Completed',
                    ]),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make()->requiresConfirmation(),
                ]),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
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
                        $filePath = is_array($data['csv_file']) ? ($data['csv_file']['path'] ?? $data['csv_file'][0]) : $data['csv_file'];
                        if (strpos($filePath, 'csv-temp/') !== 0) {
                            $filePath = 'csv-temp/' . $filePath;
                        }

                        if (!Storage::disk('public')->exists($filePath)) {
                            Notification::make()
                                ->title('File tidak ditemukan')
                                ->body('Pastikan file CSV telah diunggah dengan benar.')
                                ->danger()
                                ->send();
                            return;
                        }

                        $absolutePath = Storage::disk('public')->path($filePath);
                        $handle = fopen($absolutePath, 'r');
                        if ($handle === false) {
                            Notification::make()
                                ->title('Gagal membuka file')
                                ->danger()
                                ->send();
                            return;
                        }

                        $header = fgetcsv($handle, 0, ',');
                        $required = ['nama', 'lokasi', 'tanggal_mulai', 'tanggal_selesai', 'kategori', 'status', 'hadiah'];

                        $header = array_map('trim', array_map('strtolower', $header));

                        if (array_intersect($required, $header) !== $required) {
                            Notification::make()
                                ->title('Format CSV salah')
                                ->danger()
                                ->body('CSV harus mengandung kolom: ' . implode(', ', $required))
                                ->send();
                            fclose($handle);
                            return;
                        }

                        $namaIndex = array_search('nama', $header);
                        $deskripsiIndex = array_search('deskripsi', $header);
                        $lokasiIndex = array_search('lokasi', $header);
                        $tanggalMulaiIndex = array_search('tanggal_mulai', $header);
                        $tanggalSelesaiIndex = array_search('tanggal_selesai', $header);
                        $posterIndex = array_search('poster', $header);
                        $kategoriIndex = array_search('kategori', $header);
                        $hadiahIndex = array_search('hadiah', $header);
                        $statusIndex = array_search('status', $header);
                        $linkIndex = array_search('link', $header); // ← tambahkan ini

                        $validCategories = ['single', 'team'];
                        $validStatuses = ['upcoming', 'ongoing', 'completed'];

                        $count = 0;
                        $skipped = 0;
                        while (($row = fgetcsv($handle, 0, ',')) !== false) {
                            if (count($row) < count($required)) {
                                $skipped++;
                                continue;
                            }

                            $nama = trim($row[$namaIndex] ?? '');
                            $deskripsi = isset($row[$deskripsiIndex]) ? trim($row[$deskripsiIndex] ?? '') ?: null : null;
                            $lokasi = trim($row[$lokasiIndex] ?? '');
                            $tanggal_mulai = isset($row[$tanggalMulaiIndex]) ? trim($row[$tanggalMulaiIndex] ?? '') ?: null : null;
                            $tanggal_selesai = isset($row[$tanggalSelesaiIndex]) ? trim($row[$tanggalSelesaiIndex] ?? '') ?: null : null;
                            $poster = isset($row[$posterIndex]) ? trim($row[$posterIndex] ?? '') ?: null : null;
                            $kategori = isset($row[$kategoriIndex]) ? trim($row[$kategoriIndex] ?? '') ?: null : null;
                            $hadiah = isset($row[$hadiahIndex]) ? (float)trim($row[$hadiahIndex] ?? '0') : 0;
                            $status = isset($row[$statusIndex]) ? trim($row[$statusIndex] ?? '') ?: 'upcoming' : 'upcoming';
                            $link = isset($row[$linkIndex]) ? trim($row[$linkIndex]) : null;

                            if (empty($nama) || empty($lokasi) || empty($tanggal_mulai) || empty($tanggal_selesai) || 
                                empty($kategori) || empty($status) || $hadiah < 0 ||
                                !in_array($kategori, $validCategories) || !in_array($status, $validStatuses)) {
                                $skipped++;
                                continue;
                            }

                            try {
                                $startDate = \Carbon\Carbon::parse($tanggal_mulai);
                                $endDate = \Carbon\Carbon::parse($tanggal_selesai);
                                if ($endDate->lt($startDate) || $startDate->lt(now())) {
                                    $skipped++;
                                    continue;
                                }
                            } catch (\Exception $e) {
                                $skipped++;
                                continue;
                            }

                            if (Turnamen::where('nama', $nama)->where('lokasi', $lokasi)->exists()) {
                                $skipped++;
                                continue;
                            }

                            try {
                                Turnamen::create([
                                    'nama' => $nama,
                                    'deskripsi' => $deskripsi,
                                    'lokasi' => $lokasi,
                                    'tanggal_mulai' => $tanggal_mulai,
                                    'tanggal_selesai' => $tanggal_selesai,
                                    'poster' => $poster,
                                    'kategori' => $kategori,
                                    'hadiah' => $hadiah,
                                    'status' => $status,
                                    'link' => $link,
                                ]);
                                $count++;
                            } catch (\Exception $e) {
                                $skipped++;
                            }
                        }

                        fclose($handle);
                        try {
                            Storage::disk('public')->delete($filePath);
                        } catch (\Exception $e) {}

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
            'index' => Pages\ListTurnamens::route('/'),
            'create' => Pages\CreateTurnamen::route('/create'),
            'edit' => Pages\EditTurnamen::route('/{record}/edit'),
        ];
    }
}