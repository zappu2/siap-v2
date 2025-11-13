<?php

namespace App\Filament\Resources\KategoriPelatihanResource\Pages;

use App\Filament\Resources\KategoriPelatihanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKategoriPelatihan extends CreateRecord
{
    protected static string $resource = KategoriPelatihanResource::class;
    
    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()
                ->label('Simpan')
                ->color('warning'),
            $this->getCancelFormAction()
                ->label('Batal')
                ->color('gray'),
        ];
    }
    
    public function getTitle(): string
    {
        return 'Tambah Kategori Pelatihan';
    }
    
    public function getBreadcrumbs(): array
    {
        return [
            '/admin' => 'Dashboard',
            '/admin/kategori-pelatihans' => 'Kategori Pelatihan',
            '' => 'Tambah',
        ];
    }
}
