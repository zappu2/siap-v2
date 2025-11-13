<?php

namespace App\Filament\Resources\PelatihanJarakJauhResource\Pages;

use App\Filament\Resources\PelatihanJarakJauhResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePelatihanJarakJauh extends CreateRecord
{
    protected static string $resource = PelatihanJarakJauhResource::class;

    protected static ?string $title = 'Tambah Pelatihan Jarak Jauh';
}
