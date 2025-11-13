<?php

namespace App\Filament\Resources\KategoriPelatihanResource\Pages;

use App\Filament\Resources\KategoriPelatihanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKategoriPelatihans extends ListRecords
{
    protected static string $resource = KategoriPelatihanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Kategori'),
        ];
    }
    
    public function getTitle(): string
    {
        return 'Kategori Pelatihan';
    }
    
    public function getBreadcrumbs(): array
    {
        return [
            '/admin' => 'Dashboard',
            '/admin/kategori-pelatihans' => 'Kategori Pelatihan',
            '' => 'Daftar',
        ];
    }
}
