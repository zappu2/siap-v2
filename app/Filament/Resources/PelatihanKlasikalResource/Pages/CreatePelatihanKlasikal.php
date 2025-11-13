<?php

namespace App\Filament\Resources\PelatihanKlasikalResource\Pages;

use App\Filament\Resources\PelatihanKlasikalResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePelatihanKlasikal extends CreateRecord
{
    protected static string $resource = PelatihanKlasikalResource::class;

    protected static ?string $title = 'Buat Pelatihan Klasikal/Webinar';

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()
                ->label('Buat')
                ->color('warning'),
                
            $this->getCreateAnotherFormAction()
                ->label('Buat & buat lainnya')
                ->color('primary'),
                
            $this->getCancelFormAction()
                ->label('Batal')
                ->color('gray'),
        ];
    }
}
