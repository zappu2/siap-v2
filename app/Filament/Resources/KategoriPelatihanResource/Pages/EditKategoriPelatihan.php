<?php

namespace App\Filament\Resources\KategoriPelatihanResource\Pages;

use App\Filament\Resources\KategoriPelatihanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKategoriPelatihan extends EditRecord
{
    protected static string $resource = KategoriPelatihanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Hapus'),
        ];
    }
    
    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction()
                ->label('Simpan')
                ->color('warning'),
            $this->getCancelFormAction()
                ->label('Batal')
                ->color('gray'),
        ];
    }
    
    public function getTitle(): string
    {
        return 'Ubah ' . $this->getRecord()->nama;
    }
    
    public function getBreadcrumbs(): array
    {
        return [
            '/admin' => 'Dashboard',
            '/admin/kategori-pelatihans' => 'Kategori Pelatihan',
            '/admin/kategori-pelatihans/' . $this->getRecord()->id . '/edit' => $this->getRecord()->nama,
            '' => 'Ubah',
        ];
    }
}
