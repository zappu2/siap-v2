<?php

namespace App\Filament\Resources\KurikulumPelatihanResource\Pages;

use App\Filament\Resources\KurikulumPelatihanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKurikulumPelatihans extends ListRecords
{
    protected static string $resource = KurikulumPelatihanResource::class;

    protected static ?string $title = 'Kurikulum Pelatihan';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Buat')
                ->color('warning'),
        ];
    }
}
