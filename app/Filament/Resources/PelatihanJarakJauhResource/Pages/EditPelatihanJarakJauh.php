<?php

namespace App\Filament\Resources\PelatihanJarakJauhResource\Pages;

use App\Filament\Resources\PelatihanJarakJauhResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPelatihanJarakJauh extends EditRecord
{
    protected static string $resource = PelatihanJarakJauhResource::class;

    protected static ?string $title = 'Edit Pelatihan Jarak Jauh';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
