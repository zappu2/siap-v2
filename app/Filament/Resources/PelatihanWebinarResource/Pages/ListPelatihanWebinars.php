<?php

namespace App\Filament\Resources\PelatihanWebinarResource\Pages;

use App\Filament\Resources\PelatihanWebinarResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPelatihanWebinars extends ListRecords
{
    protected static string $resource = PelatihanWebinarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
