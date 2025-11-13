<?php

namespace App\Filament\Resources\PelatihanJarakJauhResource\Pages;

use App\Filament\Resources\PelatihanJarakJauhResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPelatihanJarakJauhs extends ListRecords
{
    protected static string $resource = PelatihanJarakJauhResource::class;

    protected static ?string $title = 'Pelatihan Jarak Jauh';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
