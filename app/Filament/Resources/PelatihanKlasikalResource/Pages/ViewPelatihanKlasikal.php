<?php

namespace App\Filament\Resources\PelatihanKlasikalResource\Pages;

use App\Filament\Resources\PelatihanKlasikalResource;
use App\Models\PesertaPelatihan;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Contracts\View\View;

class ViewPelatihanKlasikal extends ViewRecord implements HasTable
{
    use InteractsWithTable;

    protected static string $resource = PelatihanKlasikalResource::class;

    public function getTitle(): string
    {
        return 'Lihat ' . $this->record->nama;
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Data Pelatihan')
                    ->schema([
                        TextEntry::make('nama')
                            ->label('Nama'),
                        TextEntry::make('tanggal_pelaksanaan_mulai')
                            ->label('Tanggal Mulai')
                            ->date('d M Y'),
                        TextEntry::make('penyelenggara')
                            ->label('Penyelenggara'),
                        TextEntry::make('tanggal_pelaksanaan_selesai')
                            ->label('Tanggal Selesai')
                            ->date('d M Y'),
                        TextEntry::make('jenis_pelatihan')
                            ->label('Jenis Pelatihan'),
                        TextEntry::make('kurikulum')
                            ->label('Kurikulum'),
                        IconEntry::make('verifikasi')
                            ->label('Verifikasi')
                            ->boolean()
                            ->trueIcon('heroicon-o-x-circle')
                            ->falseIcon('heroicon-o-x-circle')
                            ->trueColor('danger')
                            ->falseColor('danger'),
                        TextEntry::make('selesai')
                            ->label('Selesai Ditandatangan')
                            ->badge()
                            ->color('danger')
                            ->formatStateUsing(fn (string $state): string => $state ? 'Selesai' : 'Belum'),
                        TextEntry::make('penandatangan_sertifikat')
                            ->label('Penandatangan Sertifikat'),
                        TextEntry::make('peserta')
                            ->label('Peserta Daftar')
                            ->badge()
                            ->color('danger'),
                        TextEntry::make('jumlah_isi_evaluasi')
                            ->label('Jumlah Isi Evaluasi')
                            ->badge()
                            ->color('danger')
                            ->default('0'),
                    ])
                    ->columns(2),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                PesertaPelatihan::query()->where('pelatihan_klasikal_id', $this->record->id)
            )
            ->columns([
                Tables\Columns\ImageColumn::make('foto')
                    ->label('Foto')
                    ->circular()
                    ->defaultImageUrl(function () {
                        return 'https://ui-avatars.com/api/?name=BG&color=7F9CF5&background=EBF4FF';
                    }),
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nip')
                    ->label('NIP')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_hp')
                    ->label('No.HP')
                    ->searchable(),
                Tables\Columns\TextColumn::make('diklat_yang_diikuti')
                    ->label('Diklat yang diikuti')
                    ->wrap(),
            ])
            ->actions([
                Tables\Actions\Action::make('lihat')
                    ->label('Lihat')
                    ->icon('heroicon-o-eye')
                    ->color('gray')
                    ->modalHeading(fn (PesertaPelatihan $record): string => 'Lihat ' . strtoupper($record->nama))
                    ->modalContent(function (PesertaPelatihan $record) {
                        return view('filament.modals.peserta-detail', [
                            'record' => $record
                        ]);
                    })
                    ->modalWidth('2xl')
                    ->modalActions([
                        Tables\Actions\Action::make('tutup')
                            ->label('Tutup')
                            ->color('gray')
                            ->close()
                    ]),
            ])
            ->searchPlaceholder('Cari')
            ->paginated([10, 25, 50])
            ->defaultPaginationPageOption(50)
            ->heading('Peserta Pelatihan');
    }

    public function getFooter(): ?View
    {
        return view('filament.pages.view-pelatihan-klasikal-footer', [
            'record' => $this->record,
        ]);
    }
}
