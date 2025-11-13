<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PelatihanKlasikalResource\Pages;
use App\Filament\Resources\PelatihanKlasikalResource\RelationManagers;
use App\Models\PelatihanKlasikal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PelatihanKlasikalResource extends Resource
{
    protected static ?string $model = PelatihanKlasikal::class;

    protected static ?string $slug = 'classic-courses';

    protected static ?string $navigationIcon = 'heroicon-o-building-library';
    
    protected static ?string $navigationGroup = 'Kelola Pelatihan';
    
    protected static ?string $navigationLabel = 'Pelatihan Klasikal/Webinar';
    
    protected static ?string $modelLabel = 'Pelatihan Klasikal/Webinar';
    
    protected static ?string $pluralModelLabel = 'Pelatihan Klasikal/Webinar';
    
    protected static ?int $navigationSort = 22;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Pelatihan')
                    ->schema([
                        Forms\Components\Textarea::make('nama')
                            ->label('Nama Pelatihan')
                            ->required()
                            ->placeholder('Orientasi Pegawai Pemerintah dengan Perjanjian Kerja (PPPK) Pengenalan Nilai dan Etika pada Instansi Pemerintah Angkatan')
                            ->helperText('Angkatan menggunakan angka romawi.')
                            ->hint('Contoh: "Orientasi Pegawai Pemerintah dengan Perjanjian Kerja (PPPK) Pengenalan Nilai dan Etika pada Instansi Pemerintah Angkatan I".')
                            ->rows(3)
                            ->columnSpanFull(),
                            
                        Forms\Components\Select::make('penyelenggara')
                            ->label('Penyelenggara')
                            ->required()
                            ->placeholder('Pilih salah satu opsi')
                            ->options([
                                'Balai Diklat Keagamaan Provinsi Aceh' => 'Balai Diklat Keagamaan Provinsi Aceh',
                                'Balai Diklat Keagamaan Padang' => 'Balai Diklat Keagamaan Padang',
                                'Balai Diklat Keagamaan Palembang' => 'Balai Diklat Keagamaan Palembang',
                                'Balai Diklat Keagamaan Bandung' => 'Balai Diklat Keagamaan Bandung',
                                'Balai Diklat Keagamaan Semarang' => 'Balai Diklat Keagamaan Semarang',
                                'Balai Diklat Keagamaan Denpasar' => 'Balai Diklat Keagamaan Denpasar',
                                'Balai Diklat Keagamaan Manado' => 'Balai Diklat Keagamaan Manado',
                            ])
                            ->searchable(),
                            
                        Forms\Components\Select::make('jenis_pelatihan')
                            ->label('Jenis Pelatihan')
                            ->required()
                            ->placeholder('Orientasi PPPK')
                            ->options([
                                'Orientasi PPPK' => 'Orientasi PPPK',
                                'Pelatihan Teknis' => 'Pelatihan Teknis',
                                'Pelatihan Manajerial' => 'Pelatihan Manajerial',
                                'Pelatihan Fungsional' => 'Pelatihan Fungsional',
                                'Workshop' => 'Workshop',
                                'Seminar' => 'Seminar',
                            ])
                            ->searchable(),
                            
                        Forms\Components\Select::make('kurikulum')
                            ->label('Kurikulum')
                            ->placeholder('2')
                            ->options([
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '5' => '5',
                            ])
                            ->default('2'),
                            
                        Forms\Components\DatePicker::make('tanggal_pelaksanaan_mulai')
                            ->label('Tanggal Mulai')
                            ->required(),
                            
                        Forms\Components\DatePicker::make('tanggal_pelaksanaan_selesai')
                            ->label('Tanggal Akhir')
                            ->required(),
                            
                        Forms\Components\TextInput::make('tahun')
                            ->label('Tahun')
                            ->required()
                            ->numeric()
                            ->default(2025)
                            ->maxLength(4),
                            
                        Forms\Components\TextInput::make('id_diklat')
                            ->label('ID Diklat')
                            ->required()
                            ->placeholder('ID Diklat pada SIMDIKLAT.')
                            ->helperText('ID Diklat pada SIMDIKLAT.')
                            ->maxLength(255),
                            
                        Forms\Components\Select::make('penandatangan_sertifikat')
                            ->label('Penandatangan Sertifikat')
                            ->required()
                            ->placeholder('Pilih salah satu opsi')
                            ->options([
                                'Kepala Balai Diklat' => 'Kepala Balai Diklat',
                                'Direktur Jenderal' => 'Direktur Jenderal',
                                'Menteri Agama' => 'Menteri Agama',
                                'Sekretaris Jenderal' => 'Sekretaris Jenderal',
                            ])
                            ->searchable(),
                            
                        Forms\Components\Radio::make('terlihat')
                            ->label('Terlihat')
                            ->required()
                            ->options([
                                true => 'Ya',
                                false => 'Tidak',
                            ])
                            ->default(true)
                            ->inline(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->wrap()
                    ->limit(100),
                    
                Tables\Columns\TextColumn::make('penyelenggara')
                    ->label('Penyelenggara')
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Balai Diklat Keagamaan Provinsi Aceh' => 'warning',
                        'Balai Diklat Keagamaan Padang' => 'success',
                        'Balai Diklat Keagamaan Palembang' => 'info',
                        'Balai Diklat Keagamaan Bandung' => 'primary',
                        'Balai Diklat Keagamaan Semarang' => 'danger',
                        default => 'gray',
                    }),
                    
                Tables\Columns\TextColumn::make('tanggal_pelaksanaan')
                    ->label('Tanggal Pelaksanaan')
                    ->sortable()
                    ->getStateUsing(function (PelatihanKlasikal $record): string {
                        if ($record->tanggal_pelaksanaan_mulai && $record->tanggal_pelaksanaan_selesai) {
                            return $record->tanggal_pelaksanaan_mulai->format('d M Y') . ' - ' . 
                                   $record->tanggal_pelaksanaan_selesai->format('d M Y');
                        }
                        return '-';
                    }),
                    
                Tables\Columns\TextColumn::make('peserta')
                    ->label('Peserta')
                    ->sortable()
                    ->badge()
                    ->color('success'),
                    
                Tables\Columns\IconColumn::make('verifikasi')
                    ->label('Verifikasi')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray'),
                    
                Tables\Columns\IconColumn::make('selesai')
                    ->label('Selesai')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('bisa_ditandatangani')
                    ->label('Bisa ditandatangani')
                    ->options([
                        1 => 'Ya',
                        0 => 'Tidak',
                    ])
                    ->placeholder('-'),
                    
                Tables\Filters\SelectFilter::make('verifikasi')
                    ->label('Verifikasi')
                    ->options([
                        1 => 'Terverifikasi',
                        0 => 'Belum Verifikasi',
                    ])
                    ->placeholder('-'),
                    
                Tables\Filters\SelectFilter::make('selesai')
                    ->label('Selesai tanda tangan')
                    ->options([
                        1 => 'Selesai',
                        0 => 'Belum Selesai',
                    ])
                    ->placeholder('Semua'),
                    
                Tables\Filters\SelectFilter::make('penyelenggara')
                    ->label('Penyelenggara')
                    ->options([
                        'Balai Diklat Keagamaan Provinsi Aceh' => 'Balai Diklat Keagamaan Provinsi Aceh',
                        'Balai Diklat Keagamaan Padang' => 'Balai Diklat Keagamaan Padang',
                        'Balai Diklat Keagamaan Palembang' => 'Balai Diklat Keagamaan Palembang',
                        'Balai Diklat Keagamaan Bandung' => 'Balai Diklat Keagamaan Bandung',
                        'Balai Diklat Keagamaan Semarang' => 'Balai Diklat Keagamaan Semarang',
                    ])
                    ->placeholder('Semua'),
                    
                Tables\Filters\SelectFilter::make('tahun_pelaksanaan')
                    ->label('Tahun pelaksanaan')
                    ->options([
                        '2023' => '2023',
                        '2024' => '2024',
                        '2025' => '2025',
                    ])
                    ->placeholder('Semua'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Lihat')
                    ->icon('heroicon-o-eye')
                    ->color('gray'),
                    
                Tables\Actions\EditAction::make()
                    ->label('Ubah')
                    ->icon('heroicon-o-pencil')
                    ->color('warning'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('tanggal_pelaksanaan_mulai', 'desc')
            ->striped()
            ->paginated([5, 10, 25, 50])
            ->defaultPaginationPageOption(5);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPelatihanKlasikals::route('/'),
            'create' => Pages\CreatePelatihanKlasikal::route('/create'),
            'view' => Pages\ViewPelatihanKlasikal::route('/{record}'),
            'edit' => Pages\EditPelatihanKlasikal::route('/{record}/edit'),
        ];
    }
}
