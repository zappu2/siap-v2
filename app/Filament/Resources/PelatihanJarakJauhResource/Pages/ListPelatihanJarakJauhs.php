<?php

namespace App\Filament\Resources\PelatihanJarakJauhResource\Pages;

use App\Filament\Resources\PelatihanJarakJauhResource;
use App\Models\PelatihanJarakJauh;
use App\Services\PelatihanJarakJauhApiService;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

class ListPelatihanJarakJauhs extends ListRecords
{
    protected static string $resource = PelatihanJarakJauhResource::class;

    protected static ?string $title = 'Pelatihan Jarak Jauh';

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('sync')
                ->label('Sync dari API')
                ->icon('heroicon-o-arrow-path')
                ->color('info')
                ->requiresConfirmation()
                ->modalHeading('Sync Data dari API')
                ->modalDescription('Ini akan mengambil data terbaru dari PJJ Kemenag dan menyimpannya ke database. Proses ini mungkin membutuhkan waktu beberapa saat.')
                ->modalSubmitActionLabel('Ya, Sync Sekarang')
                ->action(function () {
                    $this->syncFromApi();
                }),
            Actions\CreateAction::make(),
        ];
    }

    protected function syncFromApi(): void
    {
        try {
            $apiService = app(PelatihanJarakJauhApiService::class);
            $courses = $apiService->refreshCourses();

            if ($courses->isEmpty()) {
                Notification::make()
                    ->title('Gagal mengambil data')
                    ->body('Tidak ada data yang ditemukan dari API.')
                    ->danger()
                    ->send();
                return;
            }

            $synced = 0;
            $updated = 0;

            foreach ($courses as $course) {
                $existing = PelatihanJarakJauh::where('id', $course['id'])->first();

                $data = [
                    'nama_pelatihan' => $course['fullname'] ?? '',
                    'penyelenggara' => $this->getCategoryName($course['categoryid'] ?? 0),
                    'tanggal_mulai' => $course['startdate'] && $course['startdate'] > 0 
                        ? date('Y-m-d', $course['startdate']) 
                        : null,
                    'tanggal_selesai' => $course['enddate'] && $course['enddate'] > 0 
                        ? date('Y-m-d', $course['enddate']) 
                        : null,
                    'deskripsi' => strip_tags($course['summary'] ?? ''),
                    'terlihat' => $course['visible'] == 1,
                    'nama' => $course['fullname'] ?? '',
                    'display_name' => $course['displayname'] ?? '',
                    'short_name' => $course['shortname'] ?? '',
                    'course_category' => (string)($course['categoryid'] ?? ''),
                    'kategori_order' => $course['categorysortorder'] ?? 0,
                    'id_number' => $course['idnumber'] ?? '',
                    'summary' => $course['summary'] ?? '',
                    'summary_format' => $course['summaryformat'] ?? 1,
                    'news_items' => $course['newsitems'] ?? 3,
                    'tanggal_akhir' => $course['enddate'] && $course['enddate'] > 0 
                        ? date('Y-m-d', $course['enddate']) 
                        : null,
                    'group_mode' => $course['groupmode'] ?? 0,
                    'visible' => $course['visible'] == 1,
                ];

                if ($existing) {
                    $existing->update($data);
                    $updated++;
                } else {
                    $record = new PelatihanJarakJauh($data);
                    $record->id = $course['id'];
                    $record->save();
                    $synced++;
                }
            }

            Notification::make()
                ->title('Sync berhasil!')
                ->body("Berhasil sync {$courses->count()} pelatihan ({$synced} baru, {$updated} diperbarui)")
                ->success()
                ->send();

        } catch (\Exception $e) {
            Notification::make()
                ->title('Gagal sync data')
                ->body('Error: ' . $e->getMessage())
                ->danger()
                ->send();
        }
    }

    protected function getCategoryName(int $categoryId): string
    {
        $categories = [
            0 => 'Pusbangkom MKMB',
            1 => 'Balai Diklat Keagamaan Bandung',
            2 => 'Balai Diklat Keagamaan Semarang',
            3 => 'Balai Diklat Keagamaan Denpasar',
        ];

        return $categories[$categoryId] ?? 'Pusbangkom MKMB';
    }
}
