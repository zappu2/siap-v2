<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Hapus'),
        ];
    }
    
    public function getTitle(): string
    {
        return 'Ubah ' . $this->getRecord()->name;
    }
    
    public function getBreadcrumbs(): array
    {
        return [
            '/admin' => 'Dashboard',
            '/admin/users' => 'Pengguna',
            '/admin/users/' . $this->getRecord()->id . '/edit' => $this->getRecord()->name,
            '' => 'Ubah',
        ];
    }
}
