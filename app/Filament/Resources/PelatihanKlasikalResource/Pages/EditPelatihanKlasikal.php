<?php

namespace App\Filament\Resources\PelatihanKlasikalResource\Pages;

use App\Filament\Resources\PelatihanKlasikalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPelatihanKlasikal extends EditRecord
{
    protected static string $resource = PelatihanKlasikalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
