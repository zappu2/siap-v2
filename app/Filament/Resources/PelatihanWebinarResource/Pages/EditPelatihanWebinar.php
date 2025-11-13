<?php

namespace App\Filament\Resources\PelatihanWebinarResource\Pages;

use App\Filament\Resources\PelatihanWebinarResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPelatihanWebinar extends EditRecord
{
    protected static string $resource = PelatihanWebinarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
