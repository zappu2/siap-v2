<?php

namespace App\Filament\Resources\PelatihanKlasikalResource\Pages;

use App\Filament\Resources\PelatihanKlasikalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPelatihanKlasikals extends ListRecords
{
    protected static string $resource = PelatihanKlasikalResource::class;

    protected static ?string $title = 'Pelatihan Klasikal/Webinar';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Buat')
                ->color('warning'),
                
            Actions\Action::make('ambil_data_simdiklat')
                ->label('Ambil Data SIMDIKLAT')
                ->color('success')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(function () {
                    // This would handle SIMDIKLAT data import in a real implementation
                    // For now, it's just a placeholder
                }),
        ];
    }
}
