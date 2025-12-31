<?php

namespace App\Filament\Resources\PelatihanJarakJauhResource\Pages;

use App\Filament\Resources\PelatihanJarakJauhResource;
use App\Services\PelatihanJarakJauhApiService;
use Filament\Actions;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewPelatihanJarakJauh extends ViewRecord
{
    protected static string $resource = PelatihanJarakJauhResource::class;

    protected static ?string $title = 'Detail Pelatihan';

    protected static string $view = 'filament.resources.pelatihan-jarak-jauh-resource.pages.view-pelatihan-jarak-jauh';

    public array $participants = [];
    public bool $isLoading = false;
    public bool $hasLoaded = false;

    public function mount(int | string $record): void
    {
        parent::mount($record);
        // Don't load participants on mount - let user click to load
    }

    public function loadParticipants(): void
    {
        $this->isLoading = true;
        
        try {
            $apiService = app(PelatihanJarakJauhApiService::class);
            $this->participants = $apiService->getEnrolledUsers($this->record->id)->toArray();
            $this->hasLoaded = true;
            
            Notification::make()
                ->title('Berhasil!')
                ->body('Ditemukan ' . count($this->participants) . ' peserta.')
                ->success()
                ->send();
        } catch (\Exception $e) {
            $this->participants = [];
            Notification::make()
                ->title('Gagal memuat peserta')
                ->body('Error: ' . $e->getMessage())
                ->danger()
                ->send();
        }
        
        $this->isLoading = false;
    }

    public function refreshParticipants(): void
    {
        $this->isLoading = true;
        
        try {
            $apiService = app(PelatihanJarakJauhApiService::class);
            $this->participants = $apiService->refreshEnrolledUsers($this->record->id)->toArray();
            $this->hasLoaded = true;
            
            Notification::make()
                ->title('Berhasil!')
                ->body('Data peserta berhasil diperbarui. Ditemukan ' . count($this->participants) . ' peserta.')
                ->success()
                ->send();
        } catch (\Exception $e) {
            Notification::make()
                ->title('Gagal memuat peserta')
                ->body('Error: ' . $e->getMessage())
                ->danger()
                ->send();
        }
        
        $this->isLoading = false;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('load_participants')
                ->label('Muat Peserta')
                ->icon('heroicon-o-users')
                ->color('info')
                ->visible(fn () => !$this->hasLoaded)
                ->action(fn () => $this->loadParticipants()),
            Actions\Action::make('refresh_participants')
                ->label('Refresh Peserta')
                ->icon('heroicon-o-arrow-path')
                ->color('info')
                ->visible(fn () => $this->hasLoaded)
                ->action(fn () => $this->refreshParticipants()),
            Actions\EditAction::make()
                ->label('Edit'),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informasi Pelatihan')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('id')
                                    ->label('ID'),
                                TextEntry::make('short_name')
                                    ->label('Kode')
                                    ->default('-'),
                            ]),
                        TextEntry::make('nama_pelatihan')
                            ->label('Nama Pelatihan')
                            ->columnSpanFull(),
                        TextEntry::make('display_name')
                            ->label('Display Name')
                            ->columnSpanFull()
                            ->default('-'),
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('penyelenggara')
                                    ->label('Penyelenggara')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'Balai Diklat Keagamaan Bandung' => 'warning',
                                        'Balai Diklat Keagamaan Semarang' => 'primary',
                                        'Balai Diklat Keagamaan Denpasar' => 'success',
                                        default => 'gray',
                                    }),
                                IconEntry::make('terlihat')
                                    ->label('Status')
                                    ->boolean()
                                    ->trueIcon('heroicon-o-check-circle')
                                    ->falseIcon('heroicon-o-x-circle')
                                    ->trueColor('success')
                                    ->falseColor('danger'),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('tanggal_mulai')
                                    ->label('Tanggal Mulai')
                                    ->formatStateUsing(fn ($state) => $state ? \Carbon\Carbon::parse($state)->format('d M Y') : '-'),
                                TextEntry::make('tanggal_selesai')
                                    ->label('Tanggal Selesai')
                                    ->formatStateUsing(fn ($state) => $state ? \Carbon\Carbon::parse($state)->format('d M Y') : '-'),
                            ]),
                        TextEntry::make('deskripsi')
                            ->label('Deskripsi')
                            ->html()
                            ->columnSpanFull()
                            ->default('-'),
                    ])
                    ->columns(2),
            ]);
    }

    public function getStudentsCount(): int
    {
        return collect($this->participants)->where('is_student', true)->count();
    }

    public function getTeachersCount(): int
    {
        return collect($this->participants)->where('is_teacher', true)->count();
    }

    public ?array $selectedParticipant = null;
    public bool $showCertificateModal = false;

    public function viewCertificate(int $participantId): void
    {
        $participant = collect($this->participants)->firstWhere('id', $participantId);
        
        if ($participant) {
            // Add placeholder certificate data
            $participant['certificate_file'] = $this->generatePlaceholderCertificateUrl($participant);
            $participant['certificate_tte'] = $participant['has_tte'] ?? false 
                ? $this->generatePlaceholderTTEUrl($participant) 
                : null;
            $participant['nilai_kualifikasi'] = $participant['nilai_kualifikasi'] ?? 'Sangat Baik';
            
            $this->selectedParticipant = $participant;
            $this->showCertificateModal = true;
        }
    }

    public function closeCertificateModal(): void
    {
        $this->showCertificateModal = false;
        $this->selectedParticipant = null;
    }

    public function signCertificate(): void
    {
        if (!$this->selectedParticipant) {
            return;
        }

        // Placeholder: This will call the signing API in production
        // For now, just simulate signing by setting has_tte to true
        $participantId = $this->selectedParticipant['id'];
        
        // Update the participant in the array
        $this->participants = collect($this->participants)->map(function ($p) use ($participantId) {
            if ($p['id'] === $participantId) {
                $p['has_tte'] = true;
            }
            return $p;
        })->toArray();

        // Update selected participant
        $this->selectedParticipant['has_tte'] = true;
        $this->selectedParticipant['certificate_tte'] = $this->generatePlaceholderTTEUrl($this->selectedParticipant);

        Notification::make()
            ->title('Berhasil!')
            ->body('Sertifikat berhasil ditandatangani (TTE). Placeholder - akan diintegrasikan dengan API.')
            ->success()
            ->send();
    }

    protected function generatePlaceholderCertificateUrl(array $participant): string
    {
        // Placeholder URL - will be replaced with actual API endpoint
        $name = strtolower(str_replace(' ', '-', $participant['fullname'] ?? 'participant'));
        return "https://pjj.kemenag.go.id/documents/certificate/{$participant['id']}/{$name}-certificate.pdf";
    }

    protected function generatePlaceholderTTEUrl(array $participant): string
    {
        // Placeholder URL - will be replaced with actual API endpoint
        $name = strtolower(str_replace(' ', '-', $participant['fullname'] ?? 'participant'));
        return "https://pjj.kemenag.go.id/documents/signCertificate/{$participant['id']}/{$name}-sign-cert.pdf";
    }
}
