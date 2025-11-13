<?php

namespace App\Filament\Resources\KurikulumPelatihanResource\Pages;

use App\Filament\Resources\KurikulumPelatihanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKurikulumPelatihan extends EditRecord
{
    protected static string $resource = KurikulumPelatihanResource::class;

    public function getTitle(): string
    {
        return 'Ubah ' . $this->getRecord()->nama_pelatihan;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('lihat')
                ->label('Lihat')
                ->color('gray')
                ->icon('heroicon-o-eye')
                ->action(function () {
                    // View action placeholder
                }),
                
            Actions\DeleteAction::make()
                ->label('Hapus')
                ->color('danger'),
        ];
    }
}
