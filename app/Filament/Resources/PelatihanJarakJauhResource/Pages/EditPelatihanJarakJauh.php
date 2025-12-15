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
    
    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Auto-fill nama_pelatihan from nama if not provided
        if (!empty($data['nama']) && empty($data['nama_pelatihan'])) {
            $data['nama_pelatihan'] = $data['nama'];
        }
        
        // Auto-fill penyelenggara with default value if not provided
        if (empty($data['penyelenggara'])) {
            $data['penyelenggara'] = 'BPSDM'; // Default organizer
        }
        
        // Handle date fields - map tanggal_akhir to tanggal_selesai
        if (empty($data['tanggal_mulai'])) {
            $data['tanggal_mulai'] = now()->format('Y-m-d');
        }
        
        if (empty($data['tanggal_selesai'])) {
            // Use tanggal_akhir if available, otherwise default to 30 days from start
            if (!empty($data['tanggal_akhir'])) {
                $data['tanggal_selesai'] = $data['tanggal_akhir'];
            } else {
                $data['tanggal_selesai'] = now()->addDays(30)->format('Y-m-d');
            }
        }
        
        // Ensure all fields with defaults are set and properly typed
        // Convert empty strings to proper defaults for integer fields
        $data['kategori_order'] = !empty($data['kategori_order']) ? (int)$data['kategori_order'] : 1;
        $data['summary_format'] = !empty($data['summary_format']) ? (int)$data['summary_format'] : 1;
        $data['news_items'] = !empty($data['news_items']) ? (int)$data['news_items'] : 3;
        $data['group_mode'] = !empty($data['group_mode']) ? (int)$data['group_mode'] : 0;
        $data['visible'] = isset($data['visible']) ? (bool)$data['visible'] : true;
        $data['terlihat'] = isset($data['terlihat']) ? (bool)$data['terlihat'] : true;
        
        return $data;
    }
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
