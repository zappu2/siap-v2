<?php

namespace App\Filament\Resources\PelatihanWebinarResource\Pages;

use App\Filament\Resources\PelatihanWebinarResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Storage;

class CreatePelatihanWebinar extends CreateRecord
{
    protected static string $resource = PelatihanWebinarResource::class;
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Get file size if certificate was uploaded
        if (isset($data['sertifikat_url']) && $data['sertifikat_url']) {
            $filePath = storage_path('app/public/' . $data['sertifikat_url']);
            if (file_exists($filePath)) {
                $data['sertifikat_size'] = filesize($filePath);
            }
        }
        
        return $data;
    }
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
